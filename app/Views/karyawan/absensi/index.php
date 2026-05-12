<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<div class="card">
    <div class="card-header">
        Riwayat Absensi Saya
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($absensi)): ?>
                <?php foreach ($absensi as $a): ?>
                <tr>
                    <td><?= $a['tanggal'] ?></td>
                    <td><?= $a['jam_masuk'] ?></td>
                    <td><?= $a['jam_keluar'] ?></td>
                    <td><?= $a['status'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada data absensi.
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>