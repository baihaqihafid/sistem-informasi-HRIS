<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<form action="<?= base_url('admin/user/update/'.$user['id']) ?>" method="post">

    <div class="mb-2">
        <label>Username</label>
        <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled>
    </div>

    <div class="mb-2">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control"
               value="<?= $user['nama_lengkap'] ?>">
    </div>

    <div class="mb-2">
        <label>Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-2">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>"
                    <?= ($r['id'] == $user['role_id']) ? 'selected' : '' ?>>
                    <?= $r['nama_role'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-warning">Update</button>
</form>

<?= $this->endSection() ?>