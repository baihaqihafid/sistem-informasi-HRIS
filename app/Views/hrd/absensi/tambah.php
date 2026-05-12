<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Tambah Data Absensi</h4>

<form action="<?= base_url('hrd/absensi/simpan') ?>" method="post">

    <!-- PILIH KARYAWAN -->
    <div class="mb-2">
        <label>Karyawan</label>
        <select name="karyawan_id" class="form-control" required>
            <option value="">-- Pilih Karyawan --</option>
            <?php foreach ($karyawan as $k): ?>
                <option value="<?= $k['id'] ?>">
                    <?= $k['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- TANGGAL -->
    <input type="date" name="tanggal" 
       class="form-control mb-2"
       value="<?= date('Y-m-d') ?>">

    <!-- JAM MASUK -->
    <input type="time" name="jam_masuk" class="form-control mb-2">

    <!-- JAM KELUAR -->
    <input type="time" name="jam_keluar" class="form-control mb-2">

    <!-- STATUS -->
    <select name="status" class="form-control mb-2" required>
        <option value="">-- Status --</option>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
        <option value="alpa">Alpa</option>
        <option value="cuti">Cuti</option>
    </select>

    <!-- KETERANGAN -->
    <textarea name="keterangan" class="form-control mb-2" placeholder="Keterangan (opsional)"></textarea>

    <button class="btn btn-success">Simpan</button>

</form>

<?= $this->endSection() ?>