<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Pesanan extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $data['orders'] = $this->orderModel
            ->select('orders.*, menu.nama_menu AS menu_name, menu.harga AS menu_price')
            ->join('menu', 'menu.id_menu = orders.menu_id')
            ->orderBy('orders.id', 'DESC')
            ->findAll();

        return view('admin/pesanan_baru', $data);
    }
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        $this->orderModel->update($id, [
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
