<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<a href="<?= base_url('hrd/absensi/tambah') ?>" class="btn btn-primary mb-3">
    Tambah
</a>

<div class="card">
    <div class="card-body">

        <!-- 🔥 TAMBAHAN DI SINI -->
        <div class="table-responsive">

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Divisi</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($absensi)): ?>
                    <?php $no=1; foreach ($absensi as $a): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['nip'] ?></td>
                        <td><?= $a['divisi'] ?></td>
                        <td><?= $a['tanggal'] ?></td>
                        <td><?= $a['jam_masuk'] ?></td>
                        <td><?= $a['jam_keluar'] ?></td>
                        <td><?= $a['status'] ?></td>
                        <td>
                            <a href="<?= base_url('hrd/absensi/edit/'.$a['id']) ?>" 
                               class="btn btn-warning btn-sm">Edit</a>

                            <a href="<?= base_url('hrd/absensi/hapus/'.$a['id']) ?>" 
                               onclick="return confirm('Yakin hapus?')"
                               class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Data absensi kosong</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>