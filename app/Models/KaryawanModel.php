<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: KaryawanModel
 * Mengelola data detail karyawan
 */
class KaryawanModel extends Model
{
    protected $table         = 'karyawan';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'user_id', 'nip', 'nama', 'jabatan',
        'divisi', 'alamat', 'no_hp', 'tanggal_bergabung', 'foto'
    ];

    // Ambil semua karyawan beserta data akun user-nya
    public function semuaKaryawanDenganUser()
    {
        return $this->select('karyawan.*, users.username, users.role_id, roles.nama_role')
                    ->join('users', 'users.id = karyawan.user_id')
                    ->join('roles', 'roles.id = users.role_id')
                    ->findAll();
    }

    // Cari karyawan berdasarkan user_id
    public function cariByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}