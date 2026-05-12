<?= $this->extend('layout/main') ?>

<?= $this->section('sidebar_menu') ?>
    <a href="<?= base_url('hrd/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="<?= base_url('hrd/laporan') ?>" class="nav-link active"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</a>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<!-- Filter bulan & tahun -->
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label mb-1 small">Bulan</label>
                <select name="bulan" class="form-select form-select-sm">
                    <?php for ($b = 1; $b <= 12; $b++): ?>
                        <option value="<?= $b ?>" <?= $bulan == $b ? 'selected' : '' ?>>
                            <?= date('F', mktime(0,0,0,$b,1)) ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label mb-1 small">Tahun</label>
                <input type="number" name="tahun" class="form-control form-control-sm" 
                       value="<?= $tahun ?>" style="width:90px">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                <a href="<?= base_url('hrd/laporan/export-pdf-absensi?bulan='.$bulan.'&tahun='.$tahun) ?>" 
                   class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tabel rekap -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">
        Rekap Absensi — <?= date('F', mktime(0,0,0,$bulan,1)) ?> <?= $tahun ?>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>NIP</th><th>Nama</th><th>Divisi</th>
                    <th class="text-center text-success">Hadir</th>
                    <th class="text-center text-warning">Izin</th>
                    <th class="text-center text-info">Sakit</th>
                    <th class="text-center text-danger">Alpa</th>
                    <th class="text-center text-secondary">Cuti</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekap as $i => $r): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($r['nip']) ?></td>
                    <td><?= esc($r['nama']) ?></td>
                    <td><?= esc($r['divisi']) ?></td>
                    <td class="text-center fw-bold text-success"><?= $r['total_hadir'] ?></td>
                    <td class="text-center fw-bold text-warning"><?= $r['total_izin'] ?></td>
                    <td class="text-center fw-bold text-info"><?= $r['total_sakit'] ?></td>
                    <td class="text-center fw-bold text-danger"><?= $r['total_alpa'] ?></td>
                    <td class="text-center fw-bold text-secondary"><?= $r['total_cuti'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>