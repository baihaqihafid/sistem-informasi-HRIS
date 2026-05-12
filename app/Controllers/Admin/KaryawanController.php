<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\UserModel;

/**
 * Controller: Admin/KaryawanController
 * Mengelola data detail karyawan (CRUD)
 */
class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $userModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->userModel     = new UserModel();
    }

    // Daftar semua karyawan
    public function index()
    {
        $data = [
            'judul'     => 'Data Karyawan',
            'karyawan'  => $this->karyawanModel->semuaKaryawanDenganUser(),
        ];
        return view('admin/karyawan/index', $data);
    }

    // Halaman detail karyawan
    public function detail($id)
    {
        $data = [
            'judul'    => 'Detail Karyawan',
            'karyawan' => $this->karyawanModel->find($id),
        ];
        return view('admin/karyawan/detail', $data);
    }

    // Form tambah karyawan
public function tambah()
{
    $db = \Config\Database::connect();

    $userTanpaKaryawan = $db->query(
        "SELECT users.* FROM users 
         LEFT JOIN karyawan ON karyawan.user_id = users.id 
         JOIN roles ON roles.id = users.role_id
         WHERE karyawan.id IS NULL AND roles.nama_role = 'Karyawan'"
    )->getResultArray();

    // 🔥 GENERATE NIP DISINI
    $tahun = date('Y');
    $total = $db->table('karyawan')->countAllResults() + 1;
    $noUrut = str_pad($total, 3, '0', STR_PAD_LEFT);
    $nip = "NIP-$tahun-$noUrut";

    $data = [
        'judul' => 'Tambah Data Karyawan',
        'users' => $userTanpaKaryawan,
        'nip'   => $nip
    ];

    return view('admin/karyawan/tambah', $data);
}

// Simpan data karyawan baru
public function simpan()
{
    $rules = [
        'user_id' => 'required|integer',
        'nama'    => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // 🔥 AUTO GENERATE NIP
    $tahun = date('Y');

    $db = \Config\Database::connect();
    $query = $db->query("SELECT COUNT(*) as total FROM karyawan");
    $total = $query->getRow()->total + 1;

    $noUrut = str_pad($total, 3, '0', STR_PAD_LEFT);

    $nip = "NIP-$tahun-$noUrut";

    // 🔥 SIMPAN DATA
    $this->karyawanModel->insert([
        'user_id'           => $this->request->getPost('user_id'),
        'nip'               => $nip,
        'nama'              => $this->request->getPost('nama'),
        'jabatan'           => $this->request->getPost('jabatan'),
        'divisi'            => $this->request->getPost('divisi'),
        'alamat'            => $this->request->getPost('alamat'),
        'no_hp'             => $this->request->getPost('no_hp'),
        'tanggal_bergabung' => $this->request->getPost('tanggal_bergabung'),
    ]);

    return redirect()->to('/admin/karyawan')
        ->with('success', 'Data karyawan berhasil ditambahkan.');
}
    // Form edit karyawan
    public function edit($id)
    {
        $data = [
            'judul'    => 'Edit Data Karyawan',
            'karyawan' => $this->karyawanModel->find($id),
        ];
        return view('admin/karyawan/edit', $data);
    }

    // Update data karyawan
    public function update($id)
    {
        $this->karyawanModel->update($id, [
            'nip'               => $this->request->getPost('nip'),
            'nama'              => $this->request->getPost('nama'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'divisi'            => $this->request->getPost('divisi'),
            'alamat'            => $this->request->getPost('alamat'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'tanggal_bergabung' => $this->request->getPost('tanggal_bergabung'),
        ]);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    // Hapus karyawan
    public function hapus($id)
    {
        $this->karyawanModel->delete($id);
        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil dihapus.');
    }
}