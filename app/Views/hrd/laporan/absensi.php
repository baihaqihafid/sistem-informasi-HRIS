<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<form method="get" class="row mb-3 g-2">

    <div class="col-6 col-md-2">
        <input type="date" name="tanggal" class="form-control"
               value="<?= $_GET['tanggal'] ?? '' ?>">
    </div>

    <div class="col-6 col-md-2">
        <select name="bulan" class="form-control">
            <?php for ($i=1; $i<=12; $i++): ?>
                <option value="<?= $i ?>" <?= $bulan == $i ? 'selected' : '' ?>>
                    <?= date('F', mktime(0,0,0,$i,1)) ?>
                </option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="col-6 col-md-2">
        <input type="number" name="tahun" value="<?= $tahun ?>" class="form-control">
    </div>

    <div class="col-6 col-md-2">
        <select name="status" class="form-control">
            <option value="">Semua</option>
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="alpa">Alpa</option>
            <option value="cuti">Cuti</option>
        </select>
    </div>

    <div class="col-12 col-md-4 d-flex gap-2">
        <button class="btn btn-primary w-100">Filter</button>

        <a href="<?= base_url('hrd/laporan/absensi?export=excel') ?>"
           class="btn btn-success w-100">
           Excel
        </a>

        <a href="<?= base_url('hrd/laporan/exportPdfAbsensi') ?>" 
           target="_blank" 
           class="btn btn-danger w-100">
           PDF
        </a>
    </div>

</form>

<div class="card">
    <div class="card-body">

        <!-- 🔥 INI YANG PENTING -->
        <div class="table-responsive">

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Divisi</th>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($rekap)): ?>
                    <?php $no=1; foreach ($rekap as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['nama'] ?></td>
                        <td><?= $r['nip'] ?></td>
                        <td><?= $r['divisi'] ?></td>
                        <td><?= $r['tanggal'] ?></td>
                        <td><?= $r['jam_masuk'] ?></td>
                        <td><?= $r['jam_keluar'] ?></td>
                        <td><?= $r['status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>