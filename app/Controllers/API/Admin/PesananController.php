<?php

namespace App\Controllers\API\Admin;

use App\Controllers\API\RestfulController;
use App\Models\OrderModel;

class PesananController extends RestfulController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    // =========================
    // GET ALL PESANAN
    // =========================
    public function index()
    {
        $orders = $this->orderModel
            ->select('orders.*, menu.nama_menu AS menu_name, menu.harga AS menu_price')
            ->join('menu', 'menu.id_menu = orders.menu_id')
            ->orderBy('orders.id', 'DESC')
            ->findAll();

        return $this->responseHasil(
            200,
            true,
            $orders
        );
    }

    // =========================
    // DETAIL PESANAN
    // =========================
    public function detail($id = null)
    {
        $order = $this->orderModel
            ->select('orders.*, menu.nama_menu AS menu_name, menu.harga AS menu_price')
            ->join('menu', 'menu.id_menu = orders.menu_id')
            ->where('orders.id', $id)
            ->first();

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        return $this->responseHasil(
            200,
            true,
            $order
        );
    }

    // =========================
    // UPDATE STATUS PESANAN
    // =========================
    public function updateStatus($id = null)
    {
        $order = $this->orderModel->find($id);

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        // Ambil data JSON dari PUT request
        $data = $this->request->getJSON(true);

        $status = $data['status'] ?? null;

        if (!$status) {

            return $this->responseHasil(
                400,
                false,
                'Status wajib diisi'
            );
        }

        $this->orderModel->update($id, [
            'status' => $status
        ]);

        return $this->responseHasil(
            200,
            true,
            'Status pesanan berhasil diperbarui'
        );
    }
}