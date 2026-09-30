<?php

namespace App\Controllers\API\Admin;

use App\Controllers\API\RestfulController;

class HomeController extends RestfulController
{
    public function index()
    {
        $data = [
            'message' => 'Selamat datang di API Catering',
            'app'     => 'Cetring Mobile',
            'version' => '1.0'
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }
}