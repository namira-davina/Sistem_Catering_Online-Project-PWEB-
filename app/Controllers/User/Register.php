<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Register extends BaseController
{
    public function index()
    {
        return view('user/register', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function process()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'fullname' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 8 karakter.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches' => 'Konfirmasi password tidak cocok.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('user/register', [
                'validation' => $validation
            ]);
        }

        $userModel = new UserModel();

        $userModel->save([
            'username'      => $this->request->getPost('fullname'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at'    => Time::now(),
        ]);

        $db = \Config\Database::connect();
        $user_id = $userModel->getInsertID();

        $db->table('auth_groups_users')->insert([
            'group_id' => 2, 
            'user_id'  => $user_id
        ]);

        return redirect()->to('/user/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
