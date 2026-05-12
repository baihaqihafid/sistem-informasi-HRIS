<?= $this->extend('layout/main') ?>
<?= $this->section('konten') ?>

<div class="row">

    <!-- LAPORAN ABSENSI -->
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column">

                <h5 class="mb-2">📊 Laporan Absensi</h5>

                <p class="text-muted flex-grow-1">
                    Lihat rekap kehadiran karyawan berdasarkan bulan dan tahun.
                </p>

                <a href="<?= base_url('hrd/laporan/absensi') ?>" 
                   class="btn btn-primary w-100">
                   Buka Laporan
                </a>

            </div>
        </div>
    </div>

    <!-- LAPORAN CUTI -->
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column">

                <h5 class="mb-2">📄 Laporan Cuti</h5>

                <p class="text-muted flex-grow-1">
                    Monitoring pengajuan cuti karyawan (menunggu, disetujui, ditolak).
                </p>

                <a href="<?= base_url('hrd/laporan/cuti') ?>" 
                   class="btn btn-success w-100">
                   Buka Laporan
                </a>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>