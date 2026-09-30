<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use CodeIgniter\I18n\Time;

class PasswordResetController extends RestfulController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        helper(['url']);
    }

    /**
     * 1. Kirim link reset password (API)
     * POST: /api/password/forgot
     */
    public function sendLink()
    {
        $email = $this->request->getVar('email');

        if (!$email) {
            return $this->responseHasil(400, false, 'Email harus diisi');
        }

        // cek user
        $user = $this->db->table('users')
            ->where('email', $email)
            ->get()
            ->getRow();

        if (!$user) {
            return $this->responseHasil(404, false, 'Email tidak ditemukan');
        }

        // generate token
        $token = bin2hex(random_bytes(32));

        // simpan token
        $this->db->table('password_resets')->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => Time::now()
        ]);

        // kirim email
        $emailService = \Config\Services::email();
        $emailService->setFrom(getenv('FROM_EMAIL'), getenv('FROM_NAME'));
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');
        $emailService->setMessage("
            Halo,<br><br>
            Akun Delizia Catering Anda telah meminta reset password.<br>
            Silakan masukkan token berikut pada halaman Reset Password di aplikasi Delizia Catering:<br><br>
            <div style='padding: 12px 16px; background: #f4f4f4; border-radius: 8px; font-size: 18px; font-weight: bold; letter-spacing: 1px;'>
                $token
            </div>
            <br>
            Jika Anda tidak meminta reset password, abaikan email ini dan jangan berikan token kepada siapa pun.<br><br>
            Terima kasih,<br>
            Tim Delizia Catering
        ");

        if (!$emailService->send()) {
            return $this->responseHasil(500, false, 'Gagal mengirim email');
        }

        return $this->responseHasil(200, true, [
            'message' => 'Token reset password berhasil dikirim',
            'token'   => $token // opsional untuk testing Postman
        ]);
    }

    /**
     * 2. Validasi token reset password
     * GET: /api/password/validate/{token}
     */
    public function validateToken($token = null)
    {
        if (!$token) {
            return $this->responseHasil(400, false, 'Token tidak boleh kosong');
        }

        $data = $this->db->table('password_resets')
            ->where('token', $token)
            ->get()
            ->getRow();

        if (!$data) {
            return $this->responseHasil(404, false, 'Token tidak valid');
        }

        return $this->responseHasil(200, true, [
            'email' => $data->email,
            'token' => $token
        ]);
    }

    /**
     * 3. Reset password
     * POST: /api/password/reset
     */
    public function resetPassword()
    {
        $token    = $this->request->getVar('token');
        $password = $this->request->getVar('password');
        $confirm  = $this->request->getVar('confirm_password');

        if (!$token || !$password || !$confirm) {
            return $this->responseHasil(400, false, 'Semua field wajib diisi');
        }

        if ($password !== $confirm) {
            return $this->responseHasil(400, false, 'Konfirmasi password tidak cocok');
        }

        $resetToken = $this->db->table('password_resets')
            ->where('token', $token)
            ->get()
            ->getRow();

        if (!$resetToken) {
            return $this->responseHasil(404, false, 'Token tidak valid atau sudah digunakan');
        }

        // update password
        $this->db->table('users')
            ->where('email', $resetToken->email)
            ->update([
                'password_hash' => password_hash($password, PASSWORD_DEFAULT)
            ]);

        // hapus token
        $this->db->table('password_resets')
            ->where('token', $token)
            ->delete();

        return $this->responseHasil(200, true, 'Password berhasil direset');
    }
}
