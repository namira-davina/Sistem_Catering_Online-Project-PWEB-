<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - DeliziaHome Admin</title>
    <link rel="stylesheet" href="/css/detail.css">
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
            <h1 class="page-title">Detail Menu</h1>
        </div>

        <div class="menu-detail-card">
            <div class="menu-detail-content">
                <div class="menu-image">
                    <img src="/images/<?= $menu['Sampul']; ?>" alt="<?= $menu['nama_menu']; ?>">
                </div>

                <div class="menu-info">
                    <div>
                        <div class="menu-header">
                            <h2 class="menu-title"><?= $menu['nama_menu']; ?></h2>
                        </div>

                        <div class="menu-details">
                            <div class="detail-item">
                                <span class="detail-label">Harga:</span>
                                <span class="detail-value price">Rp <?= number_format($menu['harga'], 0, ',', '.'); ?></span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Keterangan:</span>
                                <span class="detail-value"><?= $menu['ket']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="menu-actions">
                        <a href="/admin/ubah/<?= $menu['id_menu']; ?>" class="btn--warning">
                            Ubah Menu
                        </a>

                        <form action="<?= base_url('admin/hapus/' . $menu['id_menu']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn--danger" onclick="return confirm('Yakin Hapus Data ini?')">
                                Hapus Menu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="/admin" class="back-link">
            &larr; Kembali ke daftar menu
        </a>
    </div>
</body>
</html>