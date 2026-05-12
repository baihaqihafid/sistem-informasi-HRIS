<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<a href="<?= base_url('admin/user/tambah') ?>" class="btn btn-primary mb-3">
    Tambah User
</a>

<div class="card">
    <div class="card-body">

        <!-- 🔥 WAJIB -->
        <div class="table-responsive">

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($users)): ?>
                    <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= $u['nama_lengkap'] ?></td>
                        <td><?= $u['nama_role'] ?? '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>