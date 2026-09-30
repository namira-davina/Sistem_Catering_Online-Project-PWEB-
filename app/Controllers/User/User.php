<?php namespace App\Controllers\User;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function profile()
    {
        $data = [
            'username' => 'Username',
            'email' => 'username@gmail.com',
            'order_id' => 1
        ];

        return view('/user/profile', $data);
    }
}
