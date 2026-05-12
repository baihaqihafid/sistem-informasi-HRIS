<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\CutiModel;

class LaporanController extends BaseController
{
    public function index()
    {
        return view('hrd/laporan/index', ['judul' => 'Laporan HRIS']);
    }

    // =======================
    // 🔥 LAPORAN ABSENSI
    // =======================
    public function absensi()
    {
        $absensiModel = new AbsensiModel();

        $tanggal = $this->request->getGet('tanggal');
        $bulan   = $this->request->getGet('bulan') ?? date('m');
        $tahun   = $this->request->getGet('tahun') ?? date('Y');
        $status  = $this->request->getGet('status');

        $builder = $absensiModel
            ->select('absensi.*, karyawan.nama, karyawan.nip, karyawan.divisi')
            ->join('karyawan', 'karyawan.id = absensi.karyawan_id');

        // FILTER
        if (!empty($tanggal)) {
            $builder->where('absensi.tanggal', $tanggal);
        } else {
            $builder->where('MONTH(absensi.tanggal)', $bulan)
                    ->where('YEAR(absensi.tanggal)', $tahun);
        }

        if (!empty($status)) {
            $builder->where('absensi.status', $status);
        }

        $rekap = $builder->orderBy('absensi.tanggal', 'DESC')->findAll();

        // 🔥 EXPORT EXCEL
        if ($this->request->getGet('export') == 'excel') {

            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=laporan_absensi.xls");

            echo "
            <table border='1' cellpadding='5'>
                <tr style='background:#4CAF50;color:white'>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                </tr>
            ";

            foreach ($rekap as $r) {

                $warna = match($r['status']) {
                    'hadir' => '#d4edda',
                    'izin'  => '#fff3cd',
                    'sakit' => '#f8d7da',
                    'alpa'  => '#f5c6cb',
                    default => '#ffffff'
                };

                echo "
                <tr style='background:$warna'>
                    <td>{$r['nama']}</td>
                    <td>{$r['tanggal']}</td>
                    <td>{$r['jam_masuk']}</td>
                    <td>{$r['jam_keluar']}</td>
                    <td>{$r['status']}</td>
                </tr>";
            }

            echo "</table>";
            exit;
        }

        return view('hrd/laporan/absensi', [
            'judul' => 'Laporan Absensi',
            'rekap' => $rekap,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

    // =======================
    // 🔥 LAPORAN CUTI
    // =======================
    public function cuti()
    {
        $cutiModel = new CutiModel();

        $tahun  = $this->request->getGet('tahun') ?? date('Y');
        $status = $this->request->getGet('status');

        $builder = $cutiModel
            ->select('cuti.*, karyawan.nama')
            ->join('karyawan', 'karyawan.id = cuti.karyawan_id');

        $builder->where('YEAR(cuti.tanggal_mulai)', $tahun);

        if (!empty($status)) {
            $builder->where('cuti.status', $status);
        }

        $daftar_cuti = $builder->orderBy('cuti.created_at', 'DESC')->findAll();

        // 🔥 EXPORT EXCEL
        if ($this->request->getGet('export') == 'excel') {

            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=laporan_cuti.xls");

            echo "
            <table border='1' cellpadding='5'>
                <tr style='background:#4CAF50;color:white'>
                    <th>Nama</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                </tr>
            ";

            foreach ($daftar_cuti as $c) {

                $warna = match($c['status']) {
                    'disetujui' => '#d4edda',
                    'ditolak'   => '#f8d7da',
                    default     => '#fff3cd'
                };

                echo "
                <tr style='background:$warna'>
                    <td>{$c['nama']}</td>
                    <td>{$c['tanggal_mulai']}</td>
                    <td>{$c['tanggal_selesai']}</td>
                    <td>{$c['status']}</td>
                </tr>";
            }

            echo "</table>";
            exit;
        }

        return view('hrd/laporan/cuti', [
            'judul'        => 'Laporan Cuti',
            'daftar_cuti'  => $daftar_cuti,
            'tahun'        => $tahun,
        ]);
    }

    // Tambahkan di dalam class LaporanController

    public function exportPdfAbsensi()
    {
        $absensiModel = new AbsensiModel();
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'judul'  => 'Laporan Absensi',
            'rekap'  => $absensiModel->rekapAbsensi($bulan, $tahun),
            'bulan'  => $bulan,
            'tahun'  => $tahun,
        ];

        $html = view('hrd/laporan/pdf_absensi', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // 🔥 INLINE (preview) → paling aman, minim IDM
    $pdf = $dompdf->output();

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'attachment; filename="laporan.pdf"')
        ->setBody($pdf);
}}