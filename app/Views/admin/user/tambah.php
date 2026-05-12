<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<form action="<?= base_url('admin/user/simpan') ?>" method="post">

    <div class="mb-2">
        <label>Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="mb-2">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-2">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control">
    </div>

    <div class="mb-2">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>">
                    <?= $r['nama_role'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>