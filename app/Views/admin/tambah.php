<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu - DeliziaHome Admin</title>
    <link rel="stylesheet" href="/css/tambah.css">
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

    <div class="background-decoration"></div>

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Form Tambah Menu</h1>
        </div>

        <div class="form-card">
            <form action="/admin/simpan" method="post" class="form" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <div class="form-group">
                    <label for="inputnama" class="form-label">Nama Menu</label>
                    <div class="form-input-container">
                        <input type="text" 
                               class="form-input <?= ($validation->hasError('nama_menu')) ? 'form-input--error' : ''; ?>" 
                               id="inputnama" 
                               name="nama_menu" 
                               value="<?= old('nama_menu'); ?>" 
                               placeholder="Masukkan nama menu"
                               autofocus>
                        <?php if ($validation->hasError('nama_menu')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_menu'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputharga" class="form-label">Harga</label>
                    <div class="form-input-container">
                        <input type="text" 
                               class="form-input" 
                               id="inputharga" 
                               name="harga" 
                               value="<?= old('harga'); ?>" 
                               placeholder="Masukkan harga menu">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputket" class="form-label">Keterangan</label>
                    <div class="form-input-container">
                        <input type="text" 
                               class="form-input" 
                               id="inputket" 
                               name="ket" 
                               value="<?= old('ket'); ?>" 
                               placeholder="Masukkan keterangan menu">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputSampul" class="form-label">Gambar Sampul</label>
                    <div class="form-input-container">
                        <div class="file-input-container">
                            <input type="file" 
                                   class="file-input <?= ($validation->hasError('Sampul')) ? 'file-input--error' : ''; ?>" 
                                   id="inputSampul" 
                                   name="Sampul"
                                   accept="image/*">
                            <?php if ($validation->hasError('Sampul')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('Sampul'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="/admin" class="btn--secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn--primary">
                        Tambah Menu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('inputSampul').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Pilih file...';
            this.setAttribute('data-file-name', fileName);
        });

        document.getElementById('inputharga').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>