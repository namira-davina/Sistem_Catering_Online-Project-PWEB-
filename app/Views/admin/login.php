<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - DeliziaHome</title>
    <link rel="stylesheet" href="/css/login_admin.css">
</head>

<body>
    <div class="login-container">
        <a href="/home" class="back-btn">←</a>
        
        <div class="login-card">
            <header class="login-header">
                <h1 class="brand-title">DeliziaHome</h1>
                <p class="login-subtitle">Login Administrator</p>
                <span class="admin-badge">ADMIN ACCESS</span>
            </header>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/admin/login" method="post">
                <?= csrf_field(); ?>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Admin</label>
                    <input type="text" 
                           id="email" 
                           name="email" 
                           class="form-input <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan Email admin"
                           value="<?= old('email') ?>"
                           required>
                    <?php if ($validation->hasError('email')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input <?= ($validation->hasError('password_hash')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan password admin"
                           required>
                    <?php if ($validation->hasError('password_hash')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password_hash') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="security-notice">
                    <p class="security-text">
                        <span class="security-icon">⚠</span>
                        Akses terbatas untuk administrator berwenang
                    </p>
                </div>

                <button type="submit" class="login-btn">
                    Login sebagai Admin
                </button>
            </form>

            <footer class="login-footer">
                <p>
                    <a href="/user/login" class="footer-link">Login sebagai User</a>
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