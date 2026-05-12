<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<a href="<?= base_url('admin/karyawan/tambah') ?>" class="btn btn-primary mb-3">
    Tambah Karyawan
</a>

<div class="card">
    <div class="card-body">

        <!-- 🔥 INI WAJIB -->
        <div class="table-responsive">

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($karyawan)): ?>
                    <?php $no=1; foreach ($karyawan as $k): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $k['nama'] ?></td>
                        <td><?= $k['nip'] ?></td>
                        <td><?= $k['divisi'] ?></td>
                        <td><?= $k['jabatan'] ?></td>
                        <td><?= $k['alamat'] ?></td>
                        <td><?= $k['no_hp'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/karyawan/edit/'.$k['id']) ?>"
                               class="btn btn-warning btn-sm">Edit</a>

                            <a href="<?= base_url('admin/karyawan/hapus/'.$k['id']) ?>"
                               onclick="return confirm('Yakin hapus?')"
                               class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Data kosong</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>