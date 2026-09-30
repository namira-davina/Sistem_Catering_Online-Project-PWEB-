<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Menu extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['menus'] = $this->menuModel
                ->like('nama_menu', $keyword)
                ->orLike('ket', $keyword)
                ->findAll();
        } else {
            $data['menus'] = $this->menuModel->findAll();
        }

        $data['keyword'] = $keyword;

        return view('user/menu', $data);
    }


public function detail($id_menu)
{
    $menu = $this->menuModel->find($id_menu);

    if (!$menu) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Menu tidak diketahui");
    }

    return view('user/menu_detail', ['menu' => $menu]);
}

    public function pesan($id_menu)
{
    $menu = $this->menuModel->find($id_menu);

    if (!$menu) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Menu tidak ditemukan");
    }

    return view('user/pesan_menu', ['menu' => $menu]);
}

}