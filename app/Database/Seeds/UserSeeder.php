<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: Mengisi data awal untuk tabel users
 * Password default: password123 (sudah di-hash)
 */
class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator',
                'role_id'      => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'hrd01',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Staff HRD',
                'role_id'      => 2,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'karyawan01',
                'password'     => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Budi Santoso',
                'role_id'      => 3,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);

        // Otomatis buat data karyawan untuk user role karyawan
        $this->db->table('karyawan')->insert([
            'user_id'           => 3,
            'nip'               => 'NIP-2024-001',
            'nama'              => 'Budi Santoso',
            'jabatan'           => 'Staff IT',
            'divisi'            => 'Teknologi Informasi',
            'alamat'            => 'Jl. Contoh No. 1, Surabaya',
            'no_hp'             => '081234567890',
            'tanggal_bergabung' => '2024-01-01',
        ]);
    }
}