<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - DELIZIAHOME</title>
    <link rel="stylesheet" href="/css/profile.css">
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

    <main>
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-actions">
                    <div class="profile-img">
                        <?php
                        $user = session()->get('user_data');

                        $photo = (!empty($user['photo']) && file_exists(FCPATH.'uploads/profile/'.$user['photo']))
                            ? base_url('uploads/profile/'.$user['photo'])
                            : base_url('images/profile.png');
                        ?>    
                        <img src="<?= $photo ?>" class="profile-photo">
                    </div>

                </div>
                <div class="profile-info">
                    <h2 class="user-name"><?= esc($username) ?></h2><br>
                    <p class="user-email">
                        <i class="fas fa-envelope"></i> <?= esc($email) ?>
                    </p>
                </div>
                <div class="profile-actions">
                    <a href="<?= base_url('user/profile/edit') ?>" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>