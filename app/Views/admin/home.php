<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DeliziaHome</title>
    <link rel="stylesheet" href="/css/home_admin.css">
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

    <div class="admin-container">
        <div class="admin-card">
            <header class="admin-header">
                <h1 class="admin-title">Admin Dashboard</h1>
                <p class="admin-subtitle">DeliziaHome Catering Management</p>
            </header>
            <a href="/admin" class="action-btn">
                Kelola Menu
            </a>
        </div>
    </div>
</body>
</html>