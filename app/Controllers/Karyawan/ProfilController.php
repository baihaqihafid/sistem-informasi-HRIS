<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

/**
 * Controller: Karyawan/ProfilController
 * Karyawan dapat melihat dan mengubah data profil pribadinya
 */
class ProfilController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }

    // Tampilkan halaman profil
    public function index()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));

        $data = [
            'judul'    => 'Profil Saya',
            'karyawan' => $karyawan,
        ];

        return view('karyawan/profil/index', $data);
    }

    // Update data profil (hanya field yang diizinkan)
    public function update()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));

        $this->karyawanModel->update($karyawan['id'], [
            'alamat' => $this->request->getPost('alamat'),
            'no_hp'  => $this->request->getPost('no_hp'),
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}