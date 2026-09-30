<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = ['nama_menu', 'harga', 'ket', 'Sampul'];

    public function getMenu($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id_menu' => $id])->first();
    }

 public function findMenu($keyword)
{
    return $this->like('nama_menu', $keyword)
                ->findAll();   // ✔️ HARUS findAll()
}

}
