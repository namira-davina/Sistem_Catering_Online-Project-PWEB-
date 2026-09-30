<?php

namespace App\Controllers\API\User;

use App\Controllers\API\RestfulController;
use App\Models\MenuModel;

class MenuController extends RestfulController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // =========================
    // GET ALL MENU
    // =========================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {

            $menus = $this->menuModel
                ->like('nama_menu', $keyword)
                ->orLike('ket', $keyword)
                ->findAll();

        } else {

            $menus = $this->menuModel->findAll();
        }

        $menus = array_map([$this, 'withImageUrl'], $menus);

        return $this->responseHasil(
            200,
            true,
            $menus
        );
    }

    // =========================
    // DETAIL MENU
    // =========================
    public function detail($id_menu = null)
    {
        $menu = $this->menuModel->find($id_menu);

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        $menu = $this->withImageUrl($menu);

        return $this->responseHasil(
            200,
            true,
            $menu
        );
    }

    // =========================
    // PESAN MENU
    // =========================
    public function pesan($id_menu = null)
    {
        $menu = $this->menuModel->find($id_menu);

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        $menu = $this->withImageUrl($menu);

        $data = [
            'message' => 'Menu siap dipesan',
            'menu'    => $menu
        ];

        return $this->responseHasil(
            200,
            true,
            $data
        );
    }

    private function withImageUrl(array $menu): array
    {
        if (empty($menu['Sampul'])) {
            $menu['image_url'] = null;
            return $menu;
        }

        $menu['image_url'] = $this->publicBaseUrl() . '/images/' . rawurlencode($menu['Sampul']);
        return $menu;
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
