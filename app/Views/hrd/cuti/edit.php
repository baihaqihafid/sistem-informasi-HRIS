<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<h4>Edit Data Cuti</h4>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('hrd/cuti/update/'.$cuti['id']) ?>" method="post">

            <div class="mb-2">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" 
                       value="<?= $cuti['tanggal_mulai'] ?>" 
                       class="form-control">
            </div>

            <div class="mb-2">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" 
                       value="<?= $cuti['tanggal_selesai'] ?>" 
                       class="form-control">
            </div>

            <div class="mb-2">
                <label>Alasan</label>
                <textarea name="alasan" class="form-control"><?= $cuti['alasan'] ?></textarea>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="<?= base_url('hrd/cuti') ?>" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?= $this->endSection() ?>