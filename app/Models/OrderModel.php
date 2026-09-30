<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'mobile',
        'jumlah_paket',
        'address',
        'catatan',
        'payment_method',
        'menu_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getOrdersWithMenu()
    {
        return $this->select('orders.*, menu.nama_menu, menu.harga as menu_price')
                    ->join('menu', 'menu.id_menu = orders.menu_id')
                    ->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }
}
