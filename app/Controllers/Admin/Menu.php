<?php
namespace App\Controllers\Admin;

use App\Models\MenuModel;
use App\Controllers\BaseController;

class Menu extends BaseController
{
    protected $MenuModel;
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
    }

public function index()
{
    $current = $this->request->getVar('page_menu') ?? 1;
    $cari    = $this->request->getVar('cari');

    if ($cari) {
        $menu  = $this->MenuModel->findMenu($cari);
        $pager = null;
    } else {
        $menu  = $this->MenuModel->paginate(20, 'menu');
        $pager = $this->MenuModel->pager;
    }

    $data = [
        'title'   => 'Daftar Menu',
        'menu'    => $menu,
        'pager'   => $pager,
        'current' => $current
    ];
    return view('admin/index', $data);
}


    public function detail($idmenu)
    {
        $data['menu'] = $this->MenuModel->getMenu($idmenu);

        return view('/admin/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Data Menu',
            'validation' => \Config\Services::validation(),
        ];

        return view('/admin/tambah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_menu'  => 'required',
            'Sampul' => 'uploaded[Sampul]|max_size[Sampul,2048]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->to('/admin/tambah')->withInput();
        }

        $fileSampul = $this->request->getFile('Sampul');
        $namaSampul = $fileSampul->getName();

        $fileSampul->move(FCPATH . 'images', $namaSampul);
        
        $harga = str_replace('.', '', $this->request->getVar('harga'));

        $this->MenuModel->save([
            'nama_menu'        => $this->request->getVar('nama_menu'),
            'harga'     => $harga,
            'ket'     => $this->request->getVar('ket'),
            'Sampul'       => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');
        return redirect()->to('/admin');
    }

    public function hapus($idmenu)
    {
        $this->MenuModel->delete($idmenu);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to('/admin');
    }

    public function ubah($idmenu)
    {
        
        $menu = $this->MenuModel->find($idmenu);


        $data = [
            'title'      => 'Form Ubah Data Menu',
            'validation' => \Config\Services::validation(),
            'menu'       => $this->MenuModel->getMenu($idmenu),
        ];

        return view('admin/ubah', $data);
    }

    public function update($idmenu)
    {
        if (!$this->validate([
            'nama_menu'  => 'required',
            'Sampul' => 'max_size[Sampul,2048]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->to('/admin/edit/' . $idmenu)->withInput();
        }

        $fileSampul = $this->request->getFile('Sampul');
        $namaSampul = $this->request->getVar('SampulLama');

        if ($fileSampul && $fileSampul->getError() != 4) {
            $namaSampul = $fileSampul->getName();

            $fileSampul->move(FCPATH . 'images', $namaSampul);

            $SampulLama = $this->request->getVar('SampulLama');
            $oldImage = FCPATH . 'images/' . $SampulLama;
            if ($SampulLama && $SampulLama !== 'default.png' && file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        $harga = str_replace('.', '', $this->request->getVar('harga'));
        $data = [
            'nama_menu'         => $this->request->getVar('nama_menu'),
            'harga'             => $harga,
            'ket'               => $this->request->getVar('ket'),
            'Sampul'            => $namaSampul,
        ];

        $this->MenuModel->update($idmenu, $data);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');
        return redirect()->to('/admin');
    }
}
?>
