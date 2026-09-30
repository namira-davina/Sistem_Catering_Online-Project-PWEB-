<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeliziaHome - Best Catering Website</title>
    <link rel="stylesheet" href="/css/home_user.css">
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

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert-message success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<main class="main">
    <div class="main-left">
        <h1>Best Catering Website</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a eleifend libero...</p>
        <a href="<?= base_url('user/menu') ?>" class="cta-button">View Our Menu →</a>
    </div>
</main>

</body>
</html>