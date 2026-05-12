<?= $this->extend('layout/main') ?>

<?= $this->section('sidebar_menu') ?>
    <a href="<?= base_url('hrd/dashboard') ?>" class="nav-link active"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="<?= base_url('hrd/absensi') ?>" class="nav-link"><i class="bi bi-calendar-check"></i> Absensi</a>
    <a href="<?= base_url('hrd/cuti') ?>" class="nav-link"><i class="bi bi-calendar-x"></i> Pengajuan Cuti</a>
    <a href="<?= base_url('hrd/laporan') ?>" class="nav-link"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</a>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-3 rounded"><i class="bi bi-person-check fs-4 text-success"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $hadir_hari_ini ?></div>
                    <div class="text-muted small">Hadir Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 p-3 rounded"><i class="bi bi-hourglass fs-4 text-warning"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $cuti_menunggu ?></div>
                    <div class="text-muted small">Cuti Menunggu</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded"><i class="bi bi-people fs-4 text-primary"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $total_karyawan ?></div>
                    <div class="text-muted small">Total Karyawan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel cuti menunggu -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">Pengajuan Cuti Terbaru</div>
    <div class="card-body p-0">

        <!-- 🔥 TAMBAH INI -->
        <div class="table-responsive">

            <table class="table table-hover mb-0 table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Karyawan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($cuti_terbaru)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Tidak ada pengajuan cuti baru.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($cuti_terbaru as $cuti): ?>
                        <tr>
                            <td><?= esc($cuti['nama']) ?></td>
                            <td><?= date('d/m/Y', strtotime($cuti['tanggal_mulai'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($cuti['tanggal_selesai'])) ?></td>
                            <td><?= esc(substr($cuti['alasan'], 0, 50)) ?>...</td>
                            <td>
                                <a href="<?= base_url('hrd/cuti/detail/' . $cuti['id']) ?>" 
                                   class="btn btn-sm btn-primary">
                                   Review
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>
<?= $this->endSection() ?>