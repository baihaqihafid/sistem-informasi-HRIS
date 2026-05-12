<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KaryawanModel;
use App\Models\AbsensiModel;
use App\Models\CutiModel;

/**
 * Controller: Admin/DashboardController
 * Menampilkan ringkasan data untuk halaman dashboard Admin
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $userModel     = new UserModel();
        $karyawanModel = new KaryawanModel();
        $absensiModel  = new AbsensiModel();
        $cutiModel     = new CutiModel();

        $data = [
            'judul'              => 'Dashboard Admin',
            'total_user'         => $userModel->countAll(),
            'total_karyawan'     => $karyawanModel->countAll(),
            'absensi_hari_ini'   => $absensiModel->where('tanggal', date('Y-m-d'))->countAllResults(),
            'cuti_menunggu'      => $cutiModel->where('status', 'menunggu')->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}