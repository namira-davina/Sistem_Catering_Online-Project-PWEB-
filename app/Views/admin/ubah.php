<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Menu - DeliziaHome Admin</title>
    <link rel="stylesheet" href="/css/ubah.css">
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
            <h1 class="page-title">Form Ubah Menu</h1>
        </div>

        <div class="form-card">
            <form action="/admin/update/<?= $menu['id_menu']?>" method="post" class="form" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                <input type="hidden" name="SampulLama" value="<?= $menu['Sampul'] ?>">

                <div class="form-group">
                    <label for="inputnama" class="form-label">Nama Menu</label>
                    <div class="form-input-container">
                        <input type="text" 
                               class="form-input <?= ($validation->hasError('nama_menu')) ? 'form-input--error' : ''; ?>" 
                               id="inputnama" 
                               name="nama_menu" 
                               value="<?= (old('nama_menu')) ? old('nama_menu') : $menu['nama_menu'] ?>" 
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
                               value="<?= (old('harga')) ? old('harga') : $menu['harga'] ?>" 
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
                               value="<?= (old('ket')) ? old('ket') : $menu['ket'] ?>" 
                               placeholder="Masukkan keterangan menu">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar Saat Ini</label>
                    <div class="form-input-container">
                        <div class="image-preview-container">
                            <img src="/images/<?= $menu['Sampul']?>" 
                                 alt="Sampul saat ini" 
                                 class="image-preview">
                            <span class="image-label">Gambar yang sedang digunakan</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Sampul" class="form-label">Gambar Baru</label>
                    <div class="form-input-container">
                        <div class="file-input-container">
                            <input type="file" 
                                   class="file-input <?= ($validation->hasError('Sampul')) ? 'file-input--error' : ''; ?>" 
                                   id="Sampul" 
                                   name="Sampul"
                                   accept=".jpg, .jpeg, .png">
                            <?php if ($validation->hasError('Sampul')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('Sampul'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?= base_url('admin/menu') ?>" class="btn--secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn--primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>