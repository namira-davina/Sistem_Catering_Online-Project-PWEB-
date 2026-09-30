<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - DeliziaHome Admin</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <header>
        <div class="logo">DELIZIAHOME</div>
        <nav>
            <a href="<?= base_url('/admin/home') ?>">Home</a>
            <a href="<?= base_url('/admin/menu') ?>">Menu</a>
            <a href="<?= base_url('/admin/pesanan_baru') ?>">Pesanan</a>
            <button onclick="location.href='<?= base_url('logout') ?>'">Log Out</button>
        </nav>
    </header>

    <div class="background-decoration"></div>
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Daftar Menu</h1>
        </div>

        <form action="" method="get" class="search-form">
            <div class="search-group">
                <input type="text" 
                       class="search-input" 
                       placeholder="Masukkan pencarian menu..." 
                       name="cari">
                <button type="submit" name="submit" class="search-button">
                    Cari Menu
                </button>
            </div>
        </form>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="/admin/tambah" class="btn--primary">
                + Tambah Data Menu
            </a>
        </div>

        <div class="table-container">
            <?php if (is_array($menu) && !empty($menu)): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sampul</th>
                            <th>Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1 + (4 * ($current - 1));
                        foreach ($menu as $m):
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <img src="/images/<?= $m['Sampul']; ?>" 
                                     alt="<?= $m['nama_menu']; ?>" 
                                     class="menu-image">
                            </td>
                            <td>
                                <span class="menu-name"><?= $m['nama_menu']; ?></span>
                            </td>
                            <td>
                                <a href="/admin/detail/<?= $m['id_menu']; ?>" class="btn--success">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state__icon">🍽️</div>
                    <h3>Tidak ada menu ditemukan</h3>
                    <p>Silakan tambah menu baru atau ubah kata kunci pencarian</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($menu) && isset($pager)): ?>
            <div class="pagination">
                <div class="page-info">
                    Halaman <?= $current ?> dari <?= $pager->getPageCount() ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>