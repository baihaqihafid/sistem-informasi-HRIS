<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: Mengisi data awal untuk tabel roles
 */
class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_role' => 'Admin'],
            ['id' => 2, 'nama_role' => 'HRD'],
            ['id' => 3, 'nama_role' => 'Karyawan'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}