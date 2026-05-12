<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: CutiModel
 * Mengelola data pengajuan dan persetujuan cuti
 */
class CutiModel extends Model
{
    protected $table         = 'cuti';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'karyawan_id', 'tanggal_mulai', 'tanggal_selesai',
        'alasan', 'status', 'disetujui_oleh', 'catatan_hrd',
        'created_at', 'updated_at'
    ];

    // Ambil semua pengajuan cuti beserta nama karyawan
    public function semuaPengajuanCuti()
    {
        return $this->select('cuti.*, karyawan.nama, karyawan.nip, karyawan.divisi')
                    ->join('karyawan', 'karyawan.id = cuti.karyawan_id')
                    ->orderBy('cuti.created_at', 'DESC')
                    ->findAll();
    }

    // Ambil cuti yang masih menunggu persetujuan
    public function cutiMenunggu()
    {
        return $this->select('cuti.*, karyawan.nama, karyawan.nip')
                    ->join('karyawan', 'karyawan.id = cuti.karyawan_id')
                    ->where('cuti.status', 'menunggu')
                    ->orderBy('cuti.created_at', 'ASC')
                    ->findAll();
    }

    // Riwayat cuti milik karyawan tertentu
    public function riwayatCutiKaryawan($karyawanId)
    {
        return $this->where('karyawan_id', $karyawanId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}