<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<form method="get" class="row mb-3 g-2">

    <div class="col-6 col-md-3">
        <input type="number" name="tahun" value="<?= $tahun ?>" class="form-control">
    </div>

    <div class="col-6 col-md-3">
        <select name="status" class="form-control">
            <option value="">Semua</option>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
        </select>
    </div>

    <div class="col-12 col-md-6 d-flex gap-2">
        <button class="btn btn-primary w-100">Filter</button>

        <a href="<?= base_url('hrd/laporan/cuti?export=excel') ?>"
           class="btn btn-success w-100">
           Excel
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
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($daftar_cuti)): ?>
                    <?php $no=1; foreach ($daftar_cuti as $c): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $c['nama'] ?></td>
                        <td><?= $c['tanggal_mulai'] ?></td>
                        <td><?= $c['tanggal_selesai'] ?></td>
                        <td><?= $c['alasan'] ?></td>
                        <td><?= $c['status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>