<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;

class AbsensiController extends BaseController
{
    protected $absensiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->absensiModel  = new AbsensiModel();
        $this->karyawanModel = new KaryawanModel();
    }

    // =========================
    // 🔥 LIST DATA ABSENSI
    // =========================
    public function index()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'judul'   => 'Data Absensi Karyawan',
            'absensi' => $this->absensiModel->rekapAbsensi($bulan, $tahun),
            'bulan'   => $bulan,
            'tahun'   => $tahun,
        ];

        return view('hrd/absensi/index', $data);
    }

    // =========================
    // 🔥 FORM TAMBAH
    // =========================
    public function tambah()
    {
        return view('hrd/absensi/tambah', [
            'judul'    => 'Tambah Data Absensi',
            'karyawan' => $this->karyawanModel->findAll(),
        ]);
    }

    // =========================
    // 🔥 SIMPAN
    // =========================
    public function simpan()
    {
        $rules = [
            'karyawan_id' => 'required|integer',
            'tanggal'     => 'required|valid_date',
            'status'      => 'required|in_list[hadir,izin,sakit,alpa,cuti]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->absensiModel->insert([
            'karyawan_id' => $this->request->getPost('karyawan_id'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'jam_masuk'   => $this->request->getPost('jam_masuk') ?: null,
            'jam_keluar'  => $this->request->getPost('jam_keluar') ?: null,
            'status'      => $this->request->getPost('status'),
            'keterangan'  => $this->request->getPost('keterangan'),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/hrd/absensi')
            ->with('success', 'Absensi berhasil ditambahkan.');
    }

    // =========================
    // 🔥 FORM EDIT
    // =========================
    public function edit($id)
    {
        $absensi = $this->absensiModel->find($id);

        if (!$absensi) {
            return redirect()->to('/hrd/absensi')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('hrd/absensi/edit', [
            'judul'    => 'Edit Absensi',
            'absensi'  => $absensi,
            'karyawan' => $this->karyawanModel->findAll(),
        ]);
    }

    // =========================
    // 🔥 UPDATE
    // =========================
    public function update($id)
    {
        $this->absensiModel->update($id, [
            'jam_masuk'  => $this->request->getPost('jam_masuk'),
            'jam_keluar' => $this->request->getPost('jam_keluar'),
            'status'     => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/hrd/absensi')
            ->with('success', 'Absensi berhasil diperbarui.');
    }

    // =========================
    // 🔥 HAPUS
    // =========================
    public function hapus($id)
    {
        $absensi = $this->absensiModel->find($id);

        if (!$absensi) {
            return redirect()->to('/hrd/absensi')
                ->with('error', 'Data tidak ditemukan');
        }

        $this->absensiModel->delete($id);

        return redirect()->to('/hrd/absensi')
            ->with('success', 'Absensi berhasil dihapus.');
    }
}