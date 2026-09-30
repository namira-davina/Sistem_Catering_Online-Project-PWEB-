<link rel="stylesheet" href="/css/profile.css">
<link rel="stylesheet" href="/css/edit_profile.css">

<div class="edit-profile-wrapper">
    <div class="edit-profile-card">

        <h2 class="edit-profile-title">Edit Profile</h2>

        <form class="edit-profile-form"
              action="<?= base_url('user/profile/update') ?>"
              method="post"
              enctype="multipart/form-data">

            <?= csrf_field() ?>

            <label>Username</label>
            <input type="text" name="username" value="<?= esc($username) ?>">

            <label>Foto Profile</label>
            <input type="file" name="photo" accept="image/*">

            <button type="submit">Simpan</button>
            <a href="<?= base_url('user/profile') ?>" class="btn-cancel">Kembali</a>
        </form>

    </div>
</div>
