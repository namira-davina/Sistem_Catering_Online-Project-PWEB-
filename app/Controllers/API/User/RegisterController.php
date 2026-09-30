<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class RegisterController extends RestfulController
{
    public function register()
    {
        $validation = \Config\Services::validation();

        $rules = [

            'fullname' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.'
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah terdaftar.'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 8 karakter.'
                ]
            ],

            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches'  => 'Konfirmasi password tidak cocok.'
                ]
            ]
        ];

        // VALIDASI GAGAL
        if (!$this->validate($rules)) {

            return $this->responseHasil(
                400,
                false,
                $validation->getErrors()
            );
        }

        $userModel = new UserModel();

        // SIMPAN USER
        $userModel->save([
            'username'      => $this->request->getVar('fullname'),
            'email'         => $this->request->getVar('email'),
            'password_hash' => password_hash(
                $this->request->getVar('password'),
                PASSWORD_DEFAULT
            ),
            'created_at'    => Time::now(),
        ]);

        $db = \Config\Database::connect();

        $user_id = $userModel->getInsertID();

        // ROLE USER = 2
        $db->table('auth_groups_users')->insert([
            'group_id' => 2,
            'user_id'  => $user_id
        ]);

        return $this->responseHasil(
            200,
            true,
            [
                'message' => 'Pendaftaran berhasil',
                'user_id' => $user_id
            ]
        );
    }
}