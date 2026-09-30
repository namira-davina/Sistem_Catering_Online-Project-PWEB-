<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\OrderModel;
use App\Models\MenuModel;

class OrderController extends RestfulController
{
    protected $orderModel;
    protected $menuModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->menuModel  = new MenuModel();
    }

    // =========================
    // GET ALL ORDERS
    // =========================
    public function index()
    {
        $orders = $this->orderModel
            ->select('orders.*, menu.nama_menu, menu.harga, menu.Sampul')
            ->join('menu', 'menu.id_menu = orders.menu_id')
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();

        foreach ($orders as &$order) {
            $order['total'] = $order['harga'] * $order['jumlah_paket'];
            $order = $this->withImageUrl($order);
        }

        return $this->responseHasil(
            200,
            true,
            $orders
        );
    }

    // =========================
    // CREATE ORDER
    // =========================
    public function create()
    {
        $rules = [
            'name'            => 'required',
            'mobile'          => 'required',
            'jumlah_paket'    => 'required',
            'address'         => 'required',
            'payment_method'  => 'required',
            'menu_id'         => 'required'
        ];

        if (!$this->validate($rules)) {

            return $this->responseHasil(
                400,
                false,
                $this->validator->getErrors()
            );
        }

        $menu = $this->menuModel->find(
            $this->request->getVar('menu_id')
        );

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        $data = [
            'name'           => $this->request->getVar('name'),
            'mobile'         => $this->request->getVar('mobile'),
            'jumlah_paket'   => $this->request->getVar('jumlah_paket'),
            'address'        => $this->request->getVar('address'),
            'catatan'        => $this->request->getVar('catatan'),
            'payment_method' => $this->request->getVar('payment_method'),
            'menu_id'        => $this->request->getVar('menu_id'),
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $this->orderModel->insert($data);

        $orderId = $this->orderModel->getInsertID();

        $total = $menu['harga'] * $data['jumlah_paket'];

        return $this->responseHasil(
            200,
            true,
            [
                'order_id' => $orderId,
                'status'   => 'pending',
                'total'    => $total
            ]
        );
    }

    // =========================
    // DETAIL ORDER
    // =========================
    public function detail($order_id = null)
    {
        $order = $this->orderModel
            ->select('orders.*, menu.nama_menu, menu.harga, menu.Sampul')
            ->join('menu', 'menu.id_menu = orders.menu_id')
            ->where('orders.id', $order_id)
            ->first();

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        $order['total'] =
            $order['harga'] * $order['jumlah_paket'];
        $order = $this->withImageUrl($order);

        return $this->responseHasil(
            200,
            true,
            $order
        );
    }

    // =========================
    // STATUS ORDER
    // =========================
    public function status($order_id = null)
    {
        $order = $this->orderModel->find($order_id);

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
            [
                'order_id' => $order['id'],
                'status'   => $order['status']
            ]
        );
    }

    // =========================
    // UPDATE STATUS ORDER
    // =========================
    public function updateStatus($order_id = null)
    {
        $order = $this->orderModel->find($order_id);

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        $data = $this->request->getJSON(true);

        $status = $data['status'] ?? null;

        if (!$status) {

            return $this->responseHasil(
                400,
                false,
                'Status wajib diisi'
            );
        }

        $this->orderModel->update($order_id, [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->responseHasil(
            200,
            true,
            'Status berhasil diperbarui'
        );
    }

    // =========================
    // PESANAN SELESAI
    // =========================
    public function markDelivered($order_id = null)
    {
        $order = $this->orderModel->find($order_id);

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        $this->orderModel->update($order_id, [
            'status'     => 'selesai',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->responseHasil(
            200,
            true,
            'Pesanan selesai'
        );
    }

    // =========================
    // SUBMIT RATING
    // =========================
    public function submitRating($order_id = null)
    {
        $order = $this->orderModel->find($order_id);

        if (!$order) {

            return $this->responseHasil(
                404,
                false,
                'Pesanan tidak ditemukan'
            );
        }

        $rating = $this->request->getVar('rating');
        $message = $this->request->getVar('message');

        if ($order['status'] !== 'diantar') {

            return $this->responseHasil(
                400,
                false,
                'Review hanya dapat dikirim setelah pesanan diantar'
            );
        }

        $this->orderModel->update($order_id, [
            'status'     => 'selesai',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->responseHasil(
            200,
            true,
            [
                'rating'  => $rating,
                'message' => $message,
                'status'  => 'selesai',
                'info'    => 'Terimakasih atas ratingnya. Pesanan selesai.'
            ]
        );
    }

    private function withImageUrl(array $order): array
    {
        if (empty($order['Sampul'])) {
            $order['image_url'] = null;
            return $order;
        }

        $order['image_url'] = $this->publicBaseUrl() . '/images/' . rawurlencode($order['Sampul']);
        return $order;
    }

    private function publicBaseUrl(): string
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https'
            : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? $this->request->getServer('HTTP_HOST');
        $requestUri = $_SERVER['REQUEST_URI'] ?? $this->request->getServer('REQUEST_URI') ?? '';
        $path = parse_url($requestUri, PHP_URL_PATH) ?: '';
        $basePath = preg_replace('#/api/.*$#', '', $path);
        $basePath = preg_replace('#/index\.php$#', '', $basePath);

        return rtrim($scheme . '://' . $host . $basePath, '/');
    }
}
