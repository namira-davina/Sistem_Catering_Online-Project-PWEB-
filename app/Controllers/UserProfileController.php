<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserProfileController extends BaseController
{
   public function index()
{
    $user = session()->get('user_data');

    if (!$user) {
        return redirect()->to('/user/login');
    }

    return view('user/profile', [
        'username' => $user['username'],
        'email'    => $user['email'],
        'photo'    => (!empty($user['photo']))
                        ? 'uploads/' . $user['photo']
                        : 'images/profile.png'
    ]);
}

    public function edit()
    {
        $user = session()->get('user_data');

        if (!$user) {
            return redirect()->to('/user/login');
        }

        return view('user/edit_profile', [
            'username' => $user['username'],
            'photo'    => $user['photo'] ?? 'default.png'
        ]);
    }

    public function update()
{
    $userModel = new \App\Models\UserModel();

    $user = session()->get('user_data');

    $data = [
        'username' => $this->request->getPost('username')
    ];

    $file = $this->request->getFile('photo');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/profile', $newName);
        $data['photo'] = $newName;
    }

    $userModel->update($user['id'], $data);

    session()->set('user_data', array_merge($user, $data));

    return redirect()->to('/user/profile');
}
}