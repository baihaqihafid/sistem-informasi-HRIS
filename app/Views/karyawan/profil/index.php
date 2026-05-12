<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Profil Saya</h4>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">

        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $karyawan['nama'] ?></td>
            </tr>
            <tr>
                <th>NIP</th>
                <td><?= $karyawan['nip'] ?></td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td><?= $karyawan['jabatan'] ?></td>
            </tr>
            <tr>
                <th>Divisi</th>
                <td><?= $karyawan['divisi'] ?></td>
            </tr>
        </table>

        <hr>

        <h5>Edit Profil</h5>

        <form action="<?= base_url('karyawan/profil/update') ?>" method="post">
            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= $karyawan['alamat'] ?></textarea>
            </div>

            <div class="mb-2">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="<?= $karyawan['no_hp'] ?>">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
</div>

<?= $this->endSection() ?>