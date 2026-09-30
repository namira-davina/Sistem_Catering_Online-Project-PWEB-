<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= esc($menu['nama_menu']) ?> - DeliziaHome</title>
    <link rel="stylesheet" href="/css/menu_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">DELIZIAHOME</div>
    <nav>
        <a href="<?= base_url('user/home') ?>">Home</a>
        <a href="<?= base_url('user/menu') ?>">Menu</a>
        <a href="<?= base_url('user/profile') ?>">Profile</a>
        <button onclick="location.href='<?= base_url('logout') ?>'">Log Out</button>
    </nav>
</header>

<div class="container-wrapper">
    <a href="<?= base_url('user/menu') ?>" class="back-btn">
        Back to Menu
    </a>

    <div class="container">
        <div class="image-section">
            <div class="image-container">
                <img src="<?= base_url('images/' . $menu['Sampul']) ?>"
                     alt="<?= esc($menu['nama_menu']) ?>" 
                     class="menu-image">
            </div>
        </div>

        <div class="content">
            <div class="menu-header">
                <h1 class="menu-title"><?= esc($menu['nama_menu']) ?></h1>
            </div>

            <div class="menu-description">
                <h3>Description</h3>
                <p><?= esc($menu['ket']) ?></p>
            </div>

            <div class="price-section">
                <div class="price-info">
                    <div class="current-price">
                        <span class="price-label">Price:</span>
                        <span class="price">Rp <?= number_format($menu['harga'],0,',','.') ?></span>
                    </div>
                </div>

                <div class="order-section">
                    <a href="<?= base_url('user/order/form/' . $menu['id_menu']) ?>" class="btn-order">
                        Order Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>