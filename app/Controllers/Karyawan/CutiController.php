<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\CutiModel;
use App\Models\KaryawanModel;
use App\Models\NotifikasiModel;
use App\Models\UserModel;

/**
 * Controller: Karyawan/CutiController
 * Karyawan dapat mengajukan cuti dan melihat riwayatnya
 */
class CutiController extends BaseController
{
    protected $cutiModel;
    protected $karyawanModel;
    protected $notifikasiModel;

    public function __construct()
    {
        $this->cutiModel       = new CutiModel();
        $this->karyawanModel   = new KaryawanModel();
        $this->notifikasiModel = new NotifikasiModel();
    }

    // Riwayat pengajuan cuti milik karyawan
    public function index()
    {
        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));

        $data = [
            'judul'       => 'Pengajuan Cuti Saya',
            'daftar_cuti' => $this->cutiModel->riwayatCutiKaryawan($karyawan['id']),
        ];

        return view('karyawan/cuti/index', $data);
    }

    // Form ajukan cuti baru
    public function ajukan()
    {
        return view('karyawan/cuti/ajukan', ['judul' => 'Ajukan Cuti']);
    }

    // Simpan pengajuan cuti
    public function simpan()
    {
        $rules = [
            'tanggal_mulai'   => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date',
            'alasan'          => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $karyawan = $this->karyawanModel->cariByUserId(session()->get('user_id'));

        $this->cutiModel->insert([
            'karyawan_id'     => $karyawan['id'],
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'alasan'          => $this->request->getPost('alasan'),
            'status'          => 'menunggu',
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        // Kirim notifikasi ke semua HRD
        $userModel = new UserModel();
        $semuaHrd  = $userModel->select('users.id')
                               ->join('roles', 'roles.id = users.role_id')
                               ->where('roles.nama_role', 'HRD')
                               ->findAll();

        foreach ($semuaHrd as $hrd) {
            $this->notifikasiModel->kirimNotifikasi(
                $hrd['id'],
                'Ada pengajuan cuti baru dari ' . $karyawan['nama'] . ' yang menunggu persetujuan.',
                '/hrd/cuti'
            );
        }

        return redirect()->to('/karyawan/cuti')->with('success', 'Pengajuan cuti berhasil dikirim, menunggu persetujuan HRD.');
    }
}