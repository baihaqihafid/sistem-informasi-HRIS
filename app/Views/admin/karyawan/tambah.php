<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Tambah Karyawan</h4>

<form action="<?= base_url('admin/karyawan/simpan') ?>" method="post">

    <div class="mb-2">
        <label>User</label>
        <select name="user_id" class="form-control" required>
            <option value="">-- Pilih User --</option>
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id'] ?>">
                    <?= $u['username'] ?> - <?= $u['nama_lengkap'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
    <div class="mb-2">
        <label>NIP</label>
        <input type="text" class="form-control" value="<?= $nip ?>" readonly>
    </div>    <input type="text" name="jabatan" class="form-control mb-2" placeholder="Jabatan">
    <input type="text" name="divisi" class="form-control mb-2" placeholder="Divisi">

    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>

    <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP">
    <input type="date" name="tanggal_bergabung" class="form-control mb-2">

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>