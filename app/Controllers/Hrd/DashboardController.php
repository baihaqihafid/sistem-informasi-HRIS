<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\AbsensiModel;
use App\Models\CutiModel;

/**
 * Controller: Hrd/DashboardController
 * Menampilkan ringkasan data di halaman dashboard HRD
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $absensiModel  = new AbsensiModel();
        $cutiModel     = new CutiModel();

        $data = [
            'judul'            => 'Dashboard HRD',
            'total_karyawan'   => $karyawanModel->countAll(),
            'hadir_hari_ini'   => $absensiModel->where('tanggal', date('Y-m-d'))->where('status', 'hadir')->countAllResults(),
            'cuti_menunggu'    => $cutiModel->where('status', 'menunggu')->countAllResults(),
            'cuti_disetujui'   => $cutiModel->where('status', 'disetujui')->countAllResults(),
            // 5 pengajuan cuti terbaru
            'cuti_terbaru'     => $cutiModel->cutiMenunggu(),
        ];
        return view('hrd/dashboard', $data);
    }
}