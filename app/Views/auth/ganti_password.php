<?= $this->extend('layout/main') ?>

<?= $this->section('sidebar_menu') ?>
    <?php
    // Sidebar dinamis sesuai role
    $role = session()->get('role');
    if ($role === 'Admin'): ?>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <?php elseif ($role === 'HRD'): ?>
        <a href="<?= base_url('hrd/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <?php else: ?>
        <a href="<?= base_url('karyawan/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <?php endif; ?>
    <a href="<?= base_url('ganti-password') ?>" class="nav-link active"><i class="bi bi-shield-lock"></i> Ganti Password</a>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-shield-lock text-primary"></i> Ganti Password
            </div>
            <div class="card-body">
                <form action="<?= base_url('ganti-password/proses') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_konfirmasi" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Password Baru</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>