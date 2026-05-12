<?= $this->extend('layout/main') ?>

<?= $this->section('sidebar_menu') ?>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link active"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="<?= base_url('admin/user') ?>" class="nav-link"><i class="bi bi-people"></i> Manajemen User</a>
    <a href="<?= base_url('admin/karyawan') ?>" class="nav-link"><i class="bi bi-person-badge"></i> Data Karyawan</a>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div class="row g-3 mb-4">
    <!-- Kartu Statistik -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded"><i class="bi bi-people fs-4 text-primary"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $total_user ?></div>
                    <div class="text-muted small">Total User</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-3 rounded"><i class="bi bi-person-badge fs-4 text-success"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $total_karyawan ?></div>
                    <div class="text-muted small">Total Karyawan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 p-3 rounded"><i class="bi bi-calendar-check fs-4 text-info"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $absensi_hari_ini ?></div>
                    <div class="text-muted small">Absensi Hari Ini</div>
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
</div>
<?= $this->endSection() ?>