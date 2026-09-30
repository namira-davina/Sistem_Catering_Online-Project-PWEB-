<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Shield\Authentication\Passwords\Password;

class UserLoginController extends BaseController
{
    public function __construct()
    {
        helper(['auth']);
    }

    public function index()
    {
        return view('user/login', [
            'validation' => \Config\Services::validation()
        ]);
    }

public function loginAction()
{
    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $db = db_connect();

    $user = $db->table('users')
        ->where('email', $email)
        ->orWhere('username', $email)
        ->get()
        ->getRow();

    if (!$user) {
        return redirect()->back()->with('error', 'Email atau Username tidak ditemukan.');
    }

    if (!password_verify($password, $user->password_hash)) {
        return redirect()->back()->with('error', 'Password salah.');
    }

    $auth = service('authentication');
    $auth->loginById($user->id);

   
    session()->set('user_data', [
        'id'       => $user->id,
        'username' => $user->username,
        'email'    => $user->email
    ]);

   
    $role = $db->table('auth_groups_users')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups_users.user_id', $user->id)
            ->select('auth_groups.name')
            ->get()
            ->getRow()
            ->name;

    if ($role === "admin") {
        return redirect()->to('/admin');
    }

    return redirect()->to('/user/home');
}

public function userHome()
{
    return view('user/home');
}

public function register()
{
    return view('user/register', [
        'validation' => \Config\Services::validation()
    ]);
}

public function prosesRegister()
{
    $validation = \Config\Services::validation();

    $rules = [
        'username' => 'required|min_length[3]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'confirm_password' => 'matches[password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    $db = db_connect();

    $db->table('users')->insert([
        'username'      => $this->request->getPost('username'),
        'email'         => $this->request->getPost('email'),
        'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ]);

    $userId = $db->insertID();

    $db->table('auth_groups_users')->insert([
        'user_id' => $userId,
        'group_id' => 2 
    ]);

    return redirect()->to('/user/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
}

public function forgotPassword()
{
    return view('user/forgot_password', [
        'validation' => \Config\Services::validation()
    ]);
}

public function sendResetLink()
{
    $validation = \Config\Services::validation();

    $rules = [
        'email' => 'required|valid_email'
    ];

    if (! $this->validate($rules)) {
        return view('user/forgot_password', [
            'validation' => $validation
        ]);
    }

    return redirect()->back()->with('success', 'Jika email terdaftar, link reset sudah dikirim.');
}

    public function logout()
    {
        $auth = service('authentication');
        $auth->logout();
        return redirect()->to('/');
    }
}
