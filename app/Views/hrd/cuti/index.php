<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<div class="card">
    <div class="card-body">

        <!-- 🔥 TAMBAH INI -->
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
                    <th width="250">Aksi</th>
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

                    <td>
                        <?php if ($c['status'] == 'menunggu'): ?>
                            <span class="badge bg-warning">Menunggu</span>
                        <?php elseif ($c['status'] == 'disetujui'): ?>
                            <span class="badge bg-success">Disetujui</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($c['status'] == 'menunggu'): ?>

                            <form action="<?= base_url('hrd/cuti/setujui/'.$c['id']) ?>" method="post" style="display:inline;">
                                <button class="btn btn-success btn-sm"
                                        onclick="return confirm('Setujui cuti ini?')">
                                    Setujui
                                </button>
                            </form>

                            <form action="<?= base_url('hrd/cuti/tolak/'.$c['id']) ?>" method="post" style="display:inline;">
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tolak cuti ini?')">
                                    Tolak
                                </button>
                            </form>

                        <?php endif; ?>

                        <a href="<?= base_url('hrd/cuti/edit/'.$c['id']) ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <a href="<?= base_url('hrd/cuti/hapus/'.$c['id']) ?>" 
                           onclick="return confirm('Yakin hapus data ini?')"
                           class="btn btn-dark btn-sm">Hapus</a>
                    </td>

                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada pengajuan cuti</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

        </div>
        <!-- 🔥 SAMPAI SINI -->

    </div>
</div>

<?= $this->endSection() ?>