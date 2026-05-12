<?= $this->extend('layout/main') ?>

<?= $this->section('sidebar_menu') ?>
    <a href="<?= base_url('karyawan/dashboard') ?>" class="nav-link active"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="<?= base_url('karyawan/absensi') ?>" class="nav-link"><i class="bi bi-calendar-check"></i> Absensi Saya</a>
    <a href="<?= base_url('karyawan/cuti') ?>" class="nav-link"><i class="bi bi-calendar-x"></i> Cuti Saya</a>
    <a href="<?= base_url('karyawan/profil') ?>" class="nav-link"><i class="bi bi-person-circle"></i> Profil Saya</a>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div class="row g-3 mb-4">
    <!-- Status absensi hari ini -->
    <div class="col-12">
        <?php if (!$absensi_hari_ini): ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i>
                Anda belum melakukan absensi hari ini.
                <form action="<?= base_url('karyawan/absensi/masuk') ?>" method="post" class="d-inline ms-2">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-success">Absen Masuk Sekarang</button>
                </form>
            </div>
        <?php elseif (empty($absensi_hari_ini['jam_keluar'])): ?>
            <div class="alert alert-info">
                <i class="bi bi-clock"></i>
                Anda sudah absen masuk pukul <?= $absensi_hari_ini['jam_masuk'] ?>.
                <form action="<?= base_url('karyawan/absensi/keluar') ?>" method="post" class="d-inline ms-2">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-warning">Absen Keluar</button>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                Absensi hari ini selesai. Masuk: <?= $absensi_hari_ini['jam_masuk'] ?> | Keluar: <?= $absensi_hari_ini['jam_keluar'] ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Kartu info karyawan -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title text-muted">Informasi Saya</h6>
                <p class="mb-1"><strong><?= esc($karyawan['nama']) ?></strong></p>
                <p class="mb-1 small text-muted"><?= esc($karyawan['jabatan']) ?> — <?= esc($karyawan['divisi']) ?></p>
                <p class="mb-0 small text-muted">NIP: <?= esc($karyawan['nip']) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-3 rounded"><i class="bi bi-calendar-check fs-4 text-success"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $total_hadir ?></div>
                    <div class="text-muted small">Total Hadir Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 p-3 rounded"><i class="bi bi-hourglass fs-4 text-warning"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $cuti_menunggu ?></div>
                    <div class="text-muted small">Cuti Menunggu</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel riwayat absensi terbaru -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">Riwayat Absensi Bulan Ini</div>
    <div class="card-body p-0">
        <table class="table table-sm table-hover mb-0">
            <thead class="table-light">
                <tr><th>Tanggal</th><th>Jam Masuk</th><th>Jam Keluar</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php if (empty($riwayat_absensi)): ?>
                    <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data absensi.</td></tr>
                <?php else: ?>
                    <?php foreach ($riwayat_absensi as $a): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($a['tanggal'])) ?></td>
                        <td><?= $a['jam_masuk'] ?? '-' ?></td>
                        <td><?= $a['jam_keluar'] ?? '-' ?></td>
                        <td>
                            <?php
                                $badgeMap = [
                                    'hadir' => 'success', 'izin' => 'warning',
                                    'sakit' => 'info',    'alpa' => 'danger', 'cuti' => 'secondary'
                                ];
                                $badge = $badgeMap[$a['status']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $badge ?>"><?= ucfirst($a['status']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>