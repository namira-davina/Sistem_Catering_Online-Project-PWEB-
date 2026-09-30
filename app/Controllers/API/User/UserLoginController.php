<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\UserModel;

class UserLoginController extends RestfulController
{
    // =========================
    // LOGIN USER
    // =========================
    public function login()
    {
        $email    = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $db = db_connect();

        $user = $db->table('users')
            ->where('email', $email)
            ->orWhere('username', $email)
            ->get()
            ->getRowArray();

        if (!$user) {

            return $this->responseHasil(
                400,
                false,
                'Email atau Username tidak ditemukan'
            );
        }

        if (!password_verify($password, $user['password_hash'])) {

            return $this->responseHasil(
                400,
                false,
                'Password salah'
            );
        }

        // CEK ROLE USER
        $role = $db->table('auth_groups_users')
            ->join(
                'auth_groups',
                'auth_groups.id = auth_groups_users.group_id'
            )
            ->where('auth_groups_users.user_id', $user['id'])
            ->select('auth_groups.name')
            ->get()
            ->getRow();

        // TOKEN LOGIN
        $token = bin2hex(random_bytes(32));

        $data = [
            'token' => $token,
            'user'  => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
                'role'     => $role->name ?? 'user'
            ]
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }

    // =========================
    // REGISTER USER
    // =========================
    public function register()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {

            return $this->responseHasil(
                400,
                false,
                $validation->getErrors()
            );
        }

        $db = db_connect();

        $db->table('users')->insert([
            'username'      => $this->request->getVar('username'),
            'email'         => $this->request->getVar('email'),
            'password_hash' => password_hash(
                $this->request->getVar('password'),
                PASSWORD_DEFAULT
            ),
        ]);

        $userId = $db->insertID();

        // ROLE USER = 2
        $db->table('auth_groups_users')->insert([
            'user_id'  => $userId,
            'group_id' => 2
        ]);

        return $this->responseHasil(
            200,
            true,
            'Register berhasil'
        );
    }

    // =========================
    // HOME USER
    // =========================
    public function home()
    {
        $data = [
            'message' => 'Selamat datang user'
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }

    // =========================
    // FORGOT PASSWORD
    // =========================
    public function forgotPassword()
    {
        $email = $this->request->getVar('email');

        if (!$email) {

            return $this->responseHasil(
                400,
                false,
                'Email wajib diisi'
            );
        }

        return $this->responseHasil(
            200,
            true,
            'Jika email terdaftar, link reset sudah dikirim'
        );
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        return $this->responseHasil(
            200,
            true,
            'Logout berhasil'
        );
    }
}