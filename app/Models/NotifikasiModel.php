<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: NotifikasiModel
 * Mengelola notifikasi sistem untuk setiap pengguna
 */
class NotifikasiModel extends Model
{
    protected $table         = 'notifikasi';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['user_id', 'pesan', 'url', 'status_baca', 'created_at'];

    // Kirim notifikasi ke user tertentu
    public function kirimNotifikasi($userId, $pesan, $url = null)
    {
        return $this->insert([
            'user_id'    => $userId,
            'pesan'      => $pesan,
            'url'        => $url,
            'status_baca' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Ambil notifikasi belum dibaca milik user tertentu
    public function notifikasiBelumDibaca($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status_baca', 0)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Tandai semua notifikasi user sebagai sudah dibaca
    public function tandaiSemuaSudahDibaca($userId)
    {
        return $this->where('user_id', $userId)
                    ->set(['status_baca' => 1])
                    ->update();
    }
}