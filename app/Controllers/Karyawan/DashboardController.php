<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\AbsensiModel;
use App\Models\CutiModel;

/**
 * Controller: Karyawan/DashboardController
 * Menampilkan dashboard pribadi untuk karyawan yang login
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $absensiModel  = new AbsensiModel();
        $cutiModel     = new CutiModel();

        // Ambil data karyawan berdasarkan user yang login
        $karyawan = $karyawanModel->cariByUserId(session()->get('user_id'));

        if (!$karyawan) {
            return redirect()->to('/login')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $absensiHariIni = $absensiModel->sudahAbsenHariIni($karyawan['id']);

        $data = [
            'judul'           => 'Dashboard Karyawan',
            'karyawan'        => $karyawan,
            'absensi_hari_ini'=> $absensiHariIni,
            'total_hadir'     => $absensiModel->where('karyawan_id', $karyawan['id'])->where('status', 'hadir')->countAllResults(),
            'cuti_menunggu'   => $cutiModel->where('karyawan_id', $karyawan['id'])->where('status', 'menunggu')->countAllResults(),
            'riwayat_absensi' => $absensiModel->absensiKaryawan($karyawan['id'], date('m'), date('Y')),
        ];

        return view('karyawan/dashboard', $data);
    }
}