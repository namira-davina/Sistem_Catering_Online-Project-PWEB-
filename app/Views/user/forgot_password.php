<?php $validation = $validation ?? \Config\Services::validation(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - DeliziaHome</title>
    <link rel="stylesheet" href="/css/forgot_password.css">
</head>

<body>
    <div class="login-container">
        <a href="/user/login" class="back-btn">←</a>
        
        <div class="login-card">
            <?php if(session()->has('error')): ?>
                <div class="message error">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if(session()->has('success')): ?>
                <div class="message success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <header class="login-header">
                <h1 class="brand-title">DeliziaHome</h1>
                <p class="login-subtitle">Reset Password Anda</p>
            </header>

            <div class="instructions">
                <p>Masukkan alamat email yang terkait dengan akun Anda.</p>
                <p>Kami akan mengirimkan link untuk mereset password Anda.</p>
            </div>

            <form action="<?= base_url('/user/forgot-password') ?>" method="POST" class="login-form">
            <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan email Anda"
                           value="<?= old('email') ?>"
                           required>
                    <?php if ($validation->hasError('email')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="login-btn">
                    Kirim Link Reset Password
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