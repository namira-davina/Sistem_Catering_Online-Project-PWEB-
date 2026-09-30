<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\UserModel;
use App\Models\OrderModel;

class ProfileController extends RestfulController
{
    protected $userModel;
    protected $orderModel;

    public function __construct()
    {
        $this->userModel  = new UserModel();
        $this->orderModel = new OrderModel();
    }

    // =========================
    // PROFILE USER
    // =========================
    public function profile($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return $this->responseHasil(
                404,
                false,
                'User tidak ditemukan'
            );
        }

        // hapus password
        unset($user['password_hash']);

        // ambil pesanan terakhir user
        $lastOrder = $this->orderModel
            ->orderBy('id', 'DESC')
            ->first();

        $data = [
            'user' => $user,
            'last_order_id' =>
                $lastOrder ? $lastOrder['id'] : null
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }
}