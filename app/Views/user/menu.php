<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Menu - DeliziaHome</title>
    <link rel="stylesheet" href="/css/menu.css">
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

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-utensils"></i> Our Menu</h1>
            <p class="subtitle">Discover our delicious collection of culinary delights</p>
        </div>

        <div class="search-container">
            <form action="<?= base_url('user/menu') ?>" method="get" class="search-bar">
                <div class="search-input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" 
                           name="keyword" 
                           placeholder="Search your favorite menu..." 
                           value="<?= esc($keyword ?? '') ?>"
                           class="search-input">
                    <?php if (!empty($keyword)): ?>
                    <a href="<?= base_url('user/menu') ?>" class="clear-search" title="Clear search">
                        <i class="fas fa-times"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
            
            <?php if (!empty($keyword)): ?>
            <div class="search-results-info">
                <p>Showing results for: <strong>"<?= esc($keyword) ?>"</strong></p>
                <a href="<?= base_url('user/menu') ?>" class="clear-all">
                    <i class="fas fa-times"></i> Clear Search
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <?php if (empty($menus) && !empty($keyword)): ?>
        <div class="no-results">
            <div class="no-results-icon">
                <i class="fas fa-search fa-3x"></i>
            </div>
            <h3>Menu Not Found</h3>
            <p>We couldn't find any menu matching "<?= esc($keyword) ?>"</p>
            <a href="<?= base_url('user/menu') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> View All Menu
            </a>
        </div>
        <?php else: ?>
            <div class="menu-grid">
                <?php foreach ($menus as $menu): ?>
                <div class="menu-card">
                    <div class="menu-image">
                        <img src="<?= base_url('images/' . $menu['Sampul']) ?>" 
                             alt="<?= esc($menu['nama_menu']) ?>"
                             loading="lazy">
                    </div>

                    <div class="menu-content">
                        <div class="menu-header">
                            <h3 class="menu-title">
                                <a href="<?= base_url('user/menu/detail/' . $menu['id_menu']) ?>">
                                    <?= esc($menu['nama_menu']) ?>
                                </a>
                            </h3>
                        </div>

                        <p class="menu-description"><?= esc($menu['ket']) ?></p>

                        <div class="menu-footer">
                            <div class="price-section">
                                <div class="price">
                                    Rp <?= number_format($menu['harga'], 0, ',', '.') ?>
                                </div>
                                <?php if($menu['harga'] > 50000): ?>
                                <div class="original-price">
                                    Rp <?= number_format($menu['harga'] * 1.2, 0, ',', '.') ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <a href="<?= base_url('user/menu/detail/' . $menu['id_menu']) ?>" class="btn-order">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="page-footer">
        <p>&copy; <?= date('Y') ?> DeliziaHome Catering. All rights reserved.</p>
    </footer>
</body>
</html>