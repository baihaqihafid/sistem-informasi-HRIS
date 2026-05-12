<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Detail Pengajuan Cuti</h4>

<div class="card">
    <div class="card-body">

        <p><b>Nama:</b> <?= $cuti['nama'] ?></p>
        <p><b>NIP:</b> <?= $cuti['nip'] ?></p>
        <p><b>Divisi:</b> <?= $cuti['divisi'] ?></p>
        <p><b>Tanggal Mulai:</b> <?= $cuti['tanggal_mulai'] ?></p>
        <p><b>Tanggal Selesai:</b> <?= $cuti['tanggal_selesai'] ?></p>
        <p><b>Alasan:</b> <?= $cuti['alasan'] ?></p>

        <p><b>Status:</b>
            <?php if ($cuti['status'] == 'menunggu'): ?>
                <span class="badge bg-warning">Menunggu</span>
            <?php elseif ($cuti['status'] == 'disetujui'): ?>
                <span class="badge bg-success">Disetujui</span>
            <?php else: ?>
                <span class="badge bg-danger">Ditolak</span>
            <?php endif; ?>
        </p>

        <hr>

        <?php if ($cuti['status'] == 'menunggu'): ?>

            <form action="<?= base_url('hrd/cuti/setujui/'.$cuti['id']) ?>" method="post" style="display:inline;">
                <?= csrf_field() ?>
                <button class="btn btn-success">Setujui</button>
            </form>

            <form action="<?= base_url('hrd/cuti/tolak/'.$cuti['id']) ?>" method="post" style="display:inline;">
                <?= csrf_field() ?>
                <button class="btn btn-danger">Tolak</button>
            </form>

        <?php else: ?>
            <span class="text-muted">Sudah diproses</span>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>