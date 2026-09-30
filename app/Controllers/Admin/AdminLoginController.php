<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminLoginController extends BaseController
{
    public function login()
    {
        return view('admin/login', [
            'validation' => \Config\Services::validation()
        ]);
    }
    public function loginAction()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $admin = $userModel->where('email', $email)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('auth_groups_users');
        $group = $builder->where('user_id', $admin['id'])->get()->getRow();

        if (!$group || $group->group_id != 1) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        if (!password_verify($password, $admin['password_hash'])) {
            return redirect()->back()->with('error', 'Password salah!');
        }

        session()->set([
            'isLoggedInAdmin' => true,
            'admin_id' => $admin['id'],
            'admin_email' => $admin['email']
        ]);

        return redirect()->to('/admin/home');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
