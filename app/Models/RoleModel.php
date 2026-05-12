<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model: RoleModel
 * Mengelola data role/peran pengguna
 */
class RoleModel extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_role'];
}