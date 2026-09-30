<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class PasswordResetController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        helper(['url', 'form']);
    }

    public function forgotForm()
    {
        return view('user/forgot_password', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function sendLink()
    {
        $email = $this->request->getPost('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Email harus diisi.');
        }

        $user = $this->db->table('users')->where('email', $email)->get()->getRow();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        $token = bin2hex(random_bytes(32));

        $this->db->table('password_resets')->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => Time::now()
        ]);

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
            Tim Delizia Catering"
        );

        if (!$emailService->send()) {
            return redirect()->back()->with('error', 'Gagal mengirim email.');
        }

        return redirect()->back()->with('success', 'Token reset password telah dikirim ke email Anda.');
    }

    public function resetForm($token)
    {
        return view('user/reset_password', [
            'token' => $token,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function reset()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'password' => 'required|min_length[8]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $resetToken = $this->db->table('password_resets')
            ->where('token', $token)
            ->get()
            ->getRow();

        if (!$resetToken) {
            return redirect()->back()->with('error', 'Token tidak valid.');
        }

        $this->db->table('users')
            ->where('email', $resetToken->email)
            ->update([
                'password_hash' => password_hash($password, PASSWORD_DEFAULT)
            ]);

        $this->db->table('password_resets')->where('token', $token)->delete();

        return redirect()->to('/user/login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
