<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - DeliziaHome</title>
    <link rel="stylesheet" href="/css/register_user.css">
</head>

<body>
    <div class="register-container">
        <a href="/home" class="back-btn">←</a>
        
        <div class="register-card">
            
            <header class="register-header">
                <h1 class="brand-title">DeliziaHome</h1>
                <p class="register-subtitle">Buat akun baru Anda</p>
            </header>

            
            <form action="/user/register" method="POST" class="register-form">
                <?= csrf_field(); ?>
                
               
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="form-input <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" 
                           placeholder="Masukkan nama Anda"
                           value="<?= old('username') ?>"
                           required>
                    <?php if ($validation->hasError('username')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username') ?>
                        </div>
                    <?php endif; ?>
                </div>

                
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                           placeholder="Buat password minimal 8 karakter"
                           required>
                    <?php if ($validation->hasError('password')): ?>
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
                           class="form-input <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>" 
                           placeholder="Ulangi password Anda"
                           required>
                    <?php if ($validation->hasError('confirm_password')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirm_password') ?>
                        </div>
                    <?php endif; ?>
                </div>

               
                <button type="submit" class="register-btn">
                    Daftar
                </button>
            </form>

            <footer class="register-footer">
                <p>
                    <a href="/user/login" class="footer-link">Sudah punya akun? Login di sini</a>
                </p>
            </footer>
        </div>
    </div>

    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.register-form');
            const inputs = form.querySelectorAll('.form-input');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            
        
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });
            
            
            function validatePassword() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    confirmPassword.setCustomValidity("Password tidak cocok");
                } else {
                    confirmPassword.classList.remove('is-invalid');
                    confirmPassword.setCustomValidity("");
                }
            }
            
            password.addEventListener('change', validatePassword);
            confirmPassword.addEventListener('keyup', validatePassword);
        });
    </script>
</body>
</html>