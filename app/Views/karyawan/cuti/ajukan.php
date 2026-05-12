<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Ajukan Cuti</h4>

<form action="<?= base_url('karyawan/cuti/simpan') ?>" method="post">

    <div class="mb-2">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Alasan</label>
        <textarea name="alasan" class="form-control" required></textarea>
    </div>

    <button class="btn btn-success">Ajukan</button>
</form>

<?= $this->endSection() ?>