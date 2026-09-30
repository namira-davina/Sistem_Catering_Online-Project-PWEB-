<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - DeliziaHome</title>
    <link rel="stylesheet" href="/css/reset_user.css">
</head>

<body>
    <div class="login-container">
        <a href="/user/login" class="back-btn">←</a>
        
        <div class="login-card">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="message error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="message success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <header class="login-header">
                <h1 class="brand-title">DeliziaHome</h1>
                <p class="login-subtitle">Reset Password Anda</p>
            </header>

            <div class="password-requirements">
                <p>Password harus memenuhi:</p>
                <ul>
                    <li>Minimal 8 karakter</li>
                    <li>Mengandung huruf besar dan kecil</li>
                    <li>Mengandung angka</li>
                    <li>Konfirmasi password harus sama</li>
                </ul>
            </div>

            <form action="<?= base_url('/user/reset-password') ?>" method="post" class="login-form">
                <?= csrf_field() ?>

                <input type="hidden" name="token" value="<?= esc($token) ?>" class="hidden-token">

                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input <?= ($validation && $validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan password baru"
                           required
                           minlength="8">
                    <?php if ($validation && $validation->hasError('password')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" 
                           id="confirm_password" 
                           name="confirm_password" 
                           class="form-input <?= ($validation && $validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>" 
                           placeholder="Konfirmasi password baru"
                           required>
                    <?php if ($validation && $validation->hasError('confirm_password')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirm_password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="login-btn">
                    Reset Password
                </button>
            </form>

            <footer class="login-footer">
                <p>
                    <a href="/user/login" class="footer-link">Kembali ke halaman login</a>
                </p>
                <p style="margin-top: 0.5rem;">
                    <a href="/user/register" class="footer-link">Belum punya akun? Daftar di sini</a>
                </p>
            </footer>
        </div>
    </div>
</body>
</html>