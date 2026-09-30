<?php

namespace App\Controllers\API\Admin;

use App\Controllers\API\RestfulController;
use App\Models\UserModel;

class AdminLoginController extends RestfulController
{
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();

        $admin = $userModel
            ->where('email', $email)
            ->first();

        // Cek email
        if (!$admin) {

            return $this->responseHasil(
                400,
                false,
                'Email tidak ditemukan!'
            );
        }

        // Cek role admin
        $db = \Config\Database::connect();

        $builder = $db->table('auth_groups_users');

        $group = $builder
            ->where('user_id', $admin['id'])
            ->get()
            ->getRow();

        if (!$group || $group->group_id != 1) {

            return $this->responseHasil(
                403,
                false,
                'Akses ditolak. Anda bukan admin.'
            );
        }

        // Cek password
        if (!password_verify(
            $password,
            $admin['password_hash']
        )) {

            return $this->responseHasil(
                400,
                false,
                'Password salah!'
            );
        }

        // Generate token
        $token = $this->generateToken();

        // Response sukses
        $data = [
            'token' => $token,
            'admin' => [
                'id' => $admin['id'],
                'email' => $admin['email'],
                'username' => $admin['username'] ?? null,
            ]
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }

    private function generateToken($length = 100)
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charLength = strlen($characters);

        $token = '';

        for ($i = 0; $i < $length; $i++) {

            $token .= $characters[
                rand(0, $charLength - 1)
            ];
        }

        return $token;
    }
}