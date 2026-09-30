<?php 
namespace App\Controllers\User;
use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\MenuModel;

class Order extends BaseController
{
    public function form($menu_id)
{
    $user = session()->get('user_data');

    return view('user/order_form', [
        'menu_id' => $menu_id,
        'user'    => $user
    ]);
}


public function create()
{
    $orderModel = new OrderModel();

    $data = [
        'name' => $this->request->getPost('name'),
        'mobile' => $this->request->getPost('mobile'),
        'jumlah_paket' => $this->request->getPost('jumlah_paket'),
        'address' => $this->request->getPost('address'),
        'catatan' => $this->request->getPost('catatan'),
        'payment_method' => $this->request->getPost('payment_method'),
        'menu_id' => $this->request->getPost('menu_id'),
        'created_at' => date('Y-m-d H:i:s'),
    ];

    $orderModel->insert($data);
    $order_id = $orderModel->getInsertID();

    if ($data['payment_method'] === 'COD') {
        return redirect()->to('user/order/cod_confirmation/' . $order_id);
    } else {
        return redirect()->to('user/order/payment/' . $order_id);
    }
}

    public function payment($order_id)
    {
        $orderModel = new OrderModel();
        $menuModel = new MenuModel();

        $order = $orderModel->find($order_id);
        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        $menu = $menuModel->find($order['menu_id']);
        if (!$menu) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu tidak ditemukan.');
        }

        $jumlah_paket = $order['jumlah_paket'];
        $harga = $menu['harga'];
        $subtotal = $harga * $jumlah_paket;
        $total = $subtotal; 

        return view('user/payment_confirmation', [
            'order' => $order,
            'menu' => $menu,
            'jumlah_paket' => $jumlah_paket,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    public function cod_confirmation($order_id)
{
    $orderModel = new OrderModel();
    $menuModel = new MenuModel();

    $order = $orderModel->find($order_id);
    if (!$order) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
    }

    $menu = $menuModel->find($order['menu_id']);
    if (!$menu) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu tidak ditemukan.');
    }

    $jumlah_paket = $order['jumlah_paket'];
    $harga = $menu['harga'];
    $total = $harga * $jumlah_paket;

    return view('user/cod_confirmation', [
        'order' => $order,
        'menu' => $menu,
        'jumlah_paket' => $jumlah_paket,
        'total' => $total,
    ]);
}

    public function confirmPayment($order_id)
    {
        $orderModel = new OrderModel();
        $menuModel = new MenuModel();

        $order = $orderModel->find($order_id);
        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        $menu = $menuModel->find($order['menu_id']);
        if (!$menu) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu tidak ditemukan.');
        }

        $jumlah_paket = $order['jumlah_paket'];
        $harga = $menu['harga'];
        $subtotal = $harga * $jumlah_paket;
        $total = $subtotal;

        return view('user/payment_success', [
            'order' => $order,
            'total' => $total,
        ]);
    }

public function status($order_id)
{
    $orderModel = new OrderModel();
    $order = $orderModel->find($order_id);

    if (!$order) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
    }

    if ($order['status'] == 'pending') {
        session()->setFlashdata('error', 'Pesanan masih pending, belum dapat dilacak.');
        return redirect()->to(base_url('user/home'));
    }

    if ($order['status'] == 'sedang dibuat') {
        session()->setFlashdata('error', 'Pesanan masih sedang dibuat, belum dapat dilacak.');
        return redirect()->to(base_url('user/home'));
    }

    return view('user/order_status', ['order' => $order]);
}

public function deliveryStatus($order_id)
{
    $orderModel = new OrderModel();
    $order = $orderModel->find($order_id);

    if (!$order) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
    }

    if ($order['status'] != 'diantar') {
        session()->setFlashdata('error', 'Pesanan belum dalam proses pengantaran.');
        return redirect()->to(base_url('user/order/status/' . $order_id));
    }

    $driverContact = '+62 882-3200-6170';

    return view('user/delivery_status', [
        'order' => $order,
        'driverContact' => $driverContact
    ]);
}

public function markDelivered($order_id)
{
    $orderModel = new OrderModel();

    $order = $orderModel->find($order_id);
    if (!$order) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
    }

    if ($order['status'] != 'diantar') {
        session()->setFlashdata('error', 'Review hanya dapat diisi setelah pesanan diantar.');
        return redirect()->to(base_url('user/order/status/' . $order_id));
    }

    return redirect()->to(base_url('user/order/rating/' . $order_id))
                     ->with('success', 'Silakan isi review untuk menyelesaikan pesanan.');
}


    public function ratingForm($order_id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($order_id);
        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }
        if ($order['status'] != 'diantar') {
            session()->setFlashdata('error', 'Review hanya dapat diisi setelah pesanan diantar.');
            return redirect()->to(base_url('user/order/status/' . $order_id));
        }
        return view('user/rating_form', ['order' => $order]);
    }

    public function submitRating($order_id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($order_id);
        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }
        if ($order['status'] != 'diantar') {
            session()->setFlashdata('error', 'Review hanya dapat dikirim setelah pesanan diantar.');
            return redirect()->to(base_url('user/order/status/' . $order_id));
        }

        $rating = $this->request->getPost('rating');
        $message = $this->request->getPost('message');
        $orderModel->update($order_id, [
            'status' => 'selesai',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Terimakasih atas rattingmu!');
        return redirect()->to(base_url('user/home'));
    }
}
