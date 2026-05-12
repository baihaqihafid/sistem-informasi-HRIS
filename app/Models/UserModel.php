<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: UserModel
 * Mengelola data akun pengguna sistem
 */
class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'role_id'];
    protected $useTimestamps  = true;

    // Relasi: ambil user beserta nama role-nya
    public function getUserDenganRole()
    {
        return $this->select('users.*, roles.nama_role')
                    ->join('roles', 'roles.id = users.role_id')
                    ->findAll();
    }

    // Cari user berdasarkan username untuk proses login
    public function cariUserByUsername($username)
    {
        return $this->select('users.*, roles.nama_role')
                    ->join('roles', 'roles.id = users.role_id')
                    ->where('users.username', $username)
                    ->first();
    }
}