<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\CutiModel;
use App\Models\NotifikasiModel;
use App\Models\KaryawanModel;

/**
 * Controller: Hrd/CutiController
 * HRD mengelola persetujuan atau penolakan pengajuan cuti
 */
class CutiController extends BaseController
{
    protected $cutiModel;
    protected $notifikasiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->cutiModel       = new CutiModel();
        $this->notifikasiModel = new NotifikasiModel();
        $this->karyawanModel   = new KaryawanModel();
    }

    // Daftar semua pengajuan cuti
    public function index()
    {
        $statusFilter = $this->request->getGet('status') ?? 'semua';

        $query = $this->cutiModel->select('cuti.*, karyawan.nama, karyawan.nip, karyawan.divisi')
                                  ->join('karyawan', 'karyawan.id = cuti.karyawan_id');

        if ($statusFilter !== 'semua') {
            $query->where('cuti.status', $statusFilter);
        }

        $data = [
            'judul'        => 'Pengajuan Cuti Karyawan',
            'daftar_cuti'  => $query->orderBy('cuti.created_at', 'DESC')->findAll(),
            'statusFilter' => $statusFilter,
        ];

        return view('hrd/cuti/index', $data);
    }

    // Detail satu pengajuan cuti
    public function detail($id)
    {
        $data = [
            'judul' => 'Detail Pengajuan Cuti',
            'cuti'  => $this->cutiModel->select('cuti.*, karyawan.nama, karyawan.nip, karyawan.divisi')
                                        ->join('karyawan', 'karyawan.id = cuti.karyawan_id')
                                        ->find($id),
        ];
        return view('hrd/cuti/detail', $data);
    }

    // Setujui pengajuan cuti
    public function setujui($id)
    {
        $cuti = $this->cutiModel->find($id);
        if (!$cuti) {
            return redirect()->back()->with('error', 'Data cuti tidak ditemukan.');
        }

        $this->cutiModel->update($id, [
            'status'        => 'disetujui',
            'disetujui_oleh' => session()->get('user_id'),
            'catatan_hrd'   => $this->request->getPost('catatan_hrd'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        // Kirim notifikasi ke karyawan
        $karyawan = $this->karyawanModel->find($cuti['karyawan_id']);
        $this->notifikasiModel->kirimNotifikasi(
            $karyawan['user_id'],
            'Pengajuan cuti Anda telah DISETUJUI oleh HRD.',
            '/karyawan/cuti'
        );

        return redirect()->to('/hrd/cuti')->with('success', 'Pengajuan cuti berhasil disetujui.');
    }

    // Tolak pengajuan cuti
    public function tolak($id)
    {
        $cuti = $this->cutiModel->find($id);
        if (!$cuti) {
            return redirect()->back()->with('error', 'Data cuti tidak ditemukan.');
        }

        $this->cutiModel->update($id, [
            'status'        => 'ditolak',
            'disetujui_oleh' => session()->get('user_id'),
            'catatan_hrd'   => $this->request->getPost('catatan_hrd'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        // Kirim notifikasi ke karyawan
        $karyawan = $this->karyawanModel->find($cuti['karyawan_id']);
        $this->notifikasiModel->kirimNotifikasi(
            $karyawan['user_id'],
            'Pengajuan cuti Anda telah DITOLAK. Silakan cek catatan dari HRD.',
            '/karyawan/cuti'
        );
        
        
        return redirect()->to('/hrd/cuti')->with('success', 'Pengajuan cuti berhasil ditolak.');
    }
    // =======================
// 🔥 FORM EDIT
// =======================
public function edit($id)
{
    $cuti = $this->cutiModel->find($id);

    if (!$cuti) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    return view('hrd/cuti/edit', [
        'judul' => 'Edit Cuti',
        'cuti'  => $cuti
    ]);
}

// =======================
// 🔥 UPDATE
// =======================
public function update($id)
{
    $this->cutiModel->update($id, [
        'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
        'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
        'alasan'          => $this->request->getPost('alasan'),
    ]);

    return redirect()->to('/hrd/cuti')->with('success', 'Data cuti diperbarui');
}

// =======================
// 🔥 HAPUS
// =======================
public function hapus($id)
{
    $this->cutiModel->delete($id);

    return redirect()->to('/hrd/cuti')->with('success', 'Data cuti dihapus');
}
}