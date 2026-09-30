<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru - DeliziaHome Admin</title>
    <link rel="stylesheet" href="/css/pesanan_baru.css">
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
    
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Pesanan Masuk</h1>
            <p class="page-subtitle">Kelola semua pesanan pelanggan di sini</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <h3>Tidak Ada Pesanan</h3>
                <p>Belum ada pesanan yang masuk saat ini</p>
            </div>
        <?php else: ?>
            <div class="orders-container">
                <div class="table-header">
                    <div class="total-orders">
                        Total Pesanan: <?= count($orders) ?>
                    </div>
                </div>
                
                <table class="order-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $o): ?>
                        <tr>
                            <td class="order-id">#<?= esc($o['id']) ?></td>
                            <td class="menu-name-cell"><?= esc($o['menu_name'] ?? $o['nama_menu']) ?></td>
                            <td class="price-cell">Rp <?= number_format($o['menu_price'] ?? 0,0,',','.') ?></td>
                            <td>
                                <span class="quantity-cell"><?= esc($o['jumlah_paket']) ?> pcs</span>
                            </td>
                            <td class="total-cell">Rp <?= number_format($o['total_harga'] ?? (($o['menu_price'] ?? 0) * ($o['jumlah_paket'] ?? 1)),0,',','.') ?></td>
                            <td>
                                <span class="status-cell status-<?= str_replace(' ', '_', strtolower($o['status'])) ?>">
                                    <?= esc($o['status']) ?>
                                </span>
                            </td>
                            <td>
                                <form action="<?= base_url('admin/pesanan/update_status/'.$o['id']) ?>" method="post" class="action-form">
                                    <?= csrf_field() ?>
                                    <select name="status">
                                        <option value="pending">Pending</option>
                                        <option value="sedang_dibuat">Sedang Dibuat</option>
                                        <option value="diantar">Diantar</option>
                                    </select>
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
        <div class="page-footer">
            &copy; <?= date('Y') ?> DeliziaHome Admin Panel
        </div>
    </div>
</body>
</html>