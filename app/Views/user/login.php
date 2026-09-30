<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - DeliziaHome</title>
    <link rel="stylesheet" href="/css/login_user.css">
</head>

<body>
    <div class="login-container">
        <a href="/home" class="back-btn">←</a>
        
        <div class="login-card">
            <?php if(session()->has('error')): ?>
                <div class="message error">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <header class="login-header">
                <h1 class="brand-title">DeliziaHome</h1>
                <p class="login-subtitle">Login ke akun Anda</p>
            </header>

            <form action="<?= base_url('/user/login') ?>" method="POST" class="login-form">
                <?= csrf_field(); ?>
                
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

                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="password" class="form-label">Password</label>
                        <div class="forgot-password">
                            <a href="/user/forgot-password" class="forgot-password-link">Lupa Password?</a>
                        </div>
                    </div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan password Anda"
                           required>
                    <?php if ($validation->hasError('password')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="login-btn">
                    Login
                </button>
            </form>

            <footer class="login-footer">
                <p>
                    <a href="/user/register" class="footer-link">Belum punya akun? Daftar di sini</a>
                </p>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.login-form');
            const inputs = form.querySelectorAll('.form-input');
            
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
</body>
</html>