<?php

namespace App\Controllers\API\Admin;

use App\Controllers\API\RestfulController;
use App\Models\MenuModel;

class MenuController extends RestfulController
{
    protected $MenuModel;

    public function __construct()
    {
        $this->MenuModel = new MenuModel();
    }

    // =========================
    // GET ALL MENU
    // =========================
    public function index()
    {
        $cari = $this->request->getVar('cari');

        if ($cari) {
            $menu = $this->MenuModel->findMenu($cari);
        } else {
            $menu = $this->MenuModel->findAll();
        }

        return $this->responseHasil(
            200,
            true,
            $menu
        );
    }

    // =========================
    // GET DETAIL MENU
    // =========================
    public function detail($idmenu = null)
    {
        $menu = $this->MenuModel->getMenu($idmenu);

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        return $this->responseHasil(
            200,
            true,
            $menu
        );
    }

    // =========================
    // TAMBAH MENU
    // =========================
    public function simpan()
    {
        if (!$this->validate([
            'nama_menu' => 'required',
            'Sampul' => 'uploaded[Sampul]|max_size[Sampul,2048]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
        ])) {

            return $this->responseHasil(
                400,
                false,
                $this->validator->getErrors()
            );
        }

        $fileSampul = $this->request->getFile('Sampul');

        $namaSampul = $fileSampul->getRandomName();

        $fileSampul->move('images', $namaSampul);

        $harga = str_replace(
            '.',
            '',
            $this->request->getVar('harga')
        );

        $this->MenuModel->save([
            'nama_menu' => $this->request->getVar('nama_menu'),
            'harga' => $harga,
            'ket' => $this->request->getVar('ket'),
            'Sampul' => $namaSampul,
        ]);

        return $this->responseHasil(
            200,
            true,
            'Data menu berhasil ditambahkan'
        );
    }

    // =========================
    // UPDATE MENU
    // =========================
    public function update($idmenu = null)
    {
        $menu = $this->MenuModel->find($idmenu);

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        if (!$this->validate([
            'nama_menu' => 'required',
            'Sampul' => 'max_size[Sampul,2048]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
        ])) {

            return $this->responseHasil(
                400,
                false,
                $this->validator->getErrors()
            );
        }

        $fileSampul = $this->request->getFile('Sampul');

        $namaSampul = $menu['Sampul'];

        if ($fileSampul && $fileSampul->getError() != 4) {

            $namaSampul = $fileSampul->getRandomName();

            $fileSampul->move(FCPATH . 'images', $namaSampul);

            if (
                $menu['Sampul'] != 'default.png' &&
                file_exists(FCPATH . 'images/' . $menu['Sampul'])
            ) {

                unlink(FCPATH . 'images/' . $menu['Sampul']);
            }
        }

        $harga = str_replace(
            '.',
            '',
            $this->request->getVar('harga')
        );

        $this->MenuModel->update($idmenu, [
            'nama_menu' => $this->request->getVar('nama_menu'),
            'harga' => $harga,
            'ket' => $this->request->getVar('ket'),
            'Sampul' => $namaSampul,
        ]);

        return $this->responseHasil(
            200,
            true,
            'Data menu berhasil diupdate'
        );
    }

    // =========================
    // HAPUS MENU
    // =========================
    public function hapus($idmenu = null)
    {
        $menu = $this->MenuModel->find($idmenu);

        if (!$menu) {

            return $this->responseHasil(
                404,
                false,
                'Menu tidak ditemukan'
            );
        }

        if (
            $menu['Sampul'] != 'default.png' &&
            file_exists(FCPATH . 'images/' . $menu['Sampul'])
        ) {

            unlink(FCPATH . 'images/' . $menu['Sampul']);
        }

        $this->MenuModel->delete($idmenu);

        return $this->responseHasil(
            200,
            true,
            'Data menu berhasil dihapus'
        );
    }
}
