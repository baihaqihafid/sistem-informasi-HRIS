<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; margin-bottom: 4px; }
        p.sub { text-align: center; margin: 0 0 16px 0; font-size: 11px; color: #555; }

        table { width: 100%; border-collapse: collapse; }
        th {
            background-color: #2c3e50;
            color: #fff;
            padding: 6px;
            text-align: left;
        }
        td {
            padding: 5px 6px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) td { background-color: #f9f9f9; }

        .hadir  { color: green; font-weight: bold; }
        .alpa   { color: red; font-weight: bold; }
        .izin   { color: orange; font-weight: bold; }
        .sakit  { color: steelblue; font-weight: bold; }
        .cuti   { color: gray; font-weight: bold; }
    </style>
</head>
<body>

    <h3>LAPORAN ABSENSI KARYAWAN</h3>

    <p class="sub">
        Periode: <?= date('F Y', mktime(0, 0, 0, $bulan ?? date('m'), 1, $tahun ?? date('Y'))) ?>
        &nbsp;|&nbsp;
        Dicetak: <?= date('d/m/Y H:i') ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($rekap)): ?>
                <tr>
                    <td colspan="8" style="text-align:center; padding:10px;">
                        Tidak ada data absensi.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($rekap as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($row['nip'] ?? '-') ?></td>
                    <td><?= esc($row['nama'] ?? '-') ?></td>
                    <td><?= esc($row['divisi'] ?? '-') ?></td>
                    <td>
                        <?= isset($row['tanggal']) 
                            ? date('d/m/Y', strtotime($row['tanggal'])) 
                            : '-' ?>
                    </td>
                    <td><?= $row['jam_masuk'] ?? '-' ?></td>
                    <td><?= $row['jam_keluar'] ?? '-' ?></td>
                    <td class="<?= $row['status'] ?? '' ?>">
                        <?= isset($row['status']) 
                            ? ucfirst($row['status']) 
                            : '-' ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>