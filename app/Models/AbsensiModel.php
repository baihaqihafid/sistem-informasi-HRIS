<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: AbsensiModel
 * Mengelola data absensi/kehadiran karyawan
 */
class AbsensiModel extends Model
{
    protected $table         = 'absensi';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'karyawan_id', 'tanggal', 'jam_masuk',
        'jam_keluar', 'status', 'keterangan', 'created_at'
    ];

    // Cek apakah karyawan sudah absen hari ini
    public function sudahAbsenHariIni($karyawanId)
    {
        return $this->where('karyawan_id', $karyawanId)
                    ->where('tanggal', date('Y-m-d'))
                    ->first();
    }

    // Ambil rekap absensi per karyawan dengan info nama
    public function rekapAbsensi($bulan = null, $tahun = null)
    {
        $builder = $this->select('absensi.*, karyawan.nama, karyawan.nip, karyawan.divisi')
                        ->join('karyawan', 'karyawan.id = absensi.karyawan_id');

        if ($bulan && $tahun) {
            $builder->where('MONTH(absensi.tanggal)', $bulan)
                    ->where('YEAR(absensi.tanggal)', $tahun);
        }

        return $builder->orderBy('absensi.tanggal', 'DESC')->findAll();
    }

    // Absensi milik karyawan tertentu
    public function absensiKaryawan($karyawanId, $bulan = null, $tahun = null)
    {
        $builder = $this->where('karyawan_id', $karyawanId);

        if ($bulan && $tahun) {
            $builder->where('MONTH(tanggal)', $bulan)
                    ->where('YEAR(tanggal)', $tahun);
        }

        return $builder->orderBy('tanggal', 'DESC')->findAll();
    }

    // Tambahkan di dalam AbsensiModel

    /**
     * Rekap jumlah hadir, izin, sakit, alpa per karyawan dalam satu bulan
     */
    public function rekapPerKaryawan($bulan, $tahun)
    {
        return $this->db->query("
            SELECT 
                k.nama,
                k.nip,
                k.divisi,
                SUM(CASE WHEN a.status = 'hadir' THEN 1 ELSE 0 END) AS total_hadir,
                SUM(CASE WHEN a.status = 'izin'  THEN 1 ELSE 0 END) AS total_izin,
                SUM(CASE WHEN a.status = 'sakit' THEN 1 ELSE 0 END) AS total_sakit,
                SUM(CASE WHEN a.status = 'alpa'  THEN 1 ELSE 0 END) AS total_alpa,
                SUM(CASE WHEN a.status = 'cuti'  THEN 1 ELSE 0 END) AS total_cuti,
                COUNT(a.id) AS total_hari
            FROM karyawan k
            LEFT JOIN absensi a 
                ON a.karyawan_id = k.id
                AND MONTH(a.tanggal) = ?
                AND YEAR(a.tanggal)  = ?
            GROUP BY k.id
            ORDER BY k.nama ASC
        ", [$bulan, $tahun])->getResultArray();
    }
}