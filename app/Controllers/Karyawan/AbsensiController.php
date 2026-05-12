<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;

/**
 * Controller: Karyawan/AbsensiController
 * Karyawan dapat melakukan absen masuk dan keluar secara mandiri
 */
class AbsensiController extends BaseController
{
    protected $absensiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->absensiModel  = new AbsensiModel();
        $this->karyawanModel = new KaryawanModel();
    }

    // Halaman riwayat absensi karyawan
    public function index()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));
        $bulan    = $this->request->getGet('bulan') ?? date('m');
        $tahun    = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'judul'           => 'Riwayat Absensi Saya',
            'karyawan'        => $karyawan,
            'absensi'         => $this->absensiModel->absensiKaryawan($karyawan['id'], $bulan, $tahun),
            'absensi_hari_ini'=> $this->absensiModel->sudahAbsenHariIni($karyawan['id']),
            'bulan'           => $bulan,
            'tahun'           => $tahun,
        ];

        return view('karyawan/absensi/index', $data);
    }

    // Proses absen masuk
    public function masuk()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));

        // Cek apakah sudah absen hari ini
        $sudahAbsen = $this->absensiModel->sudahAbsenHariIni($karyawan['id']);

        if ($sudahAbsen) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        $this->absensiModel->insert([
            'karyawan_id' => $karyawan['id'],
            'tanggal'     => date('Y-m-d'),
            'jam_masuk'   => date('H:i:s'),
            'status'      => 'hadir',
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Absen masuk berhasil dicatat pukul ' . date('H:i'));
    }

    // Proses absen keluar
    public function keluar()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));
        $absensi  = $this->absensiModel->sudahAbsenHariIni($karyawan['id']);

        if (!$absensi) {
            return redirect()->back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
        }

        if (!empty($absensi['jam_keluar'])) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen keluar hari ini.');
        }

        $this->absensiModel->update($absensi['id'], [
            'jam_keluar' => date('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Absen keluar berhasil dicatat pukul ' . date('H:i'));
    }
}