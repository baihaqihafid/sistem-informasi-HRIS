<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<form action="<?= base_url('admin/karyawan/update/'.$karyawan['id']) ?>" method="post">

    <div class="mb-2">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control"
               value="<?= $karyawan['nama'] ?>">
    </div>

    <div class="mb-2">
        <label>NIP</label>
        <input type="text" name="nip" class="form-control"
               value="<?= $karyawan['nip'] ?>">
    </div>

    <div class="mb-2">
        <label>Jabatan</label>
        <input type="text" name="jabatan" class="form-control"
               value="<?= $karyawan['jabatan'] ?>">
    </div>

    <div class="mb-2">
        <label>Divisi</label>
        <input type="text" name="divisi" class="form-control"
               value="<?= $karyawan['divisi'] ?>">
    </div>

    <div class="mb-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"><?= $karyawan['alamat'] ?></textarea>
    </div>

    <div class="mb-2">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="<?= $karyawan['no_hp'] ?>">
    </div>

    <button class="btn btn-warning">Update</button>
</form>

<?= $this->endSection() ?>