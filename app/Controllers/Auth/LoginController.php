<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Controller: LoginController
 * Menangani proses autentikasi: login, logout, dan redirect dashboard
 */
class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampilkan halaman login
    public function index()
    {
        // Jika sudah login, langsung redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    // Proses login
    public function proses()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan password wajib diisi.');
        }

        // Cari user di database
        $user = $this->userModel->cariUserByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Username atau password salah.')->withInput();
        }

        // Simpan data sesi login
        session()->set([
            'logged_in'    => true,
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role_id'      => $user['role_id'],
            'role'         => $user['nama_role'],
        ]);

        return redirect()->to('/dashboard');
    }

    // Redirect ke dashboard sesuai role
    public function dashboard()
    {
        $role = session()->get('role');

        switch ($role) {
            case 'Admin':
                return redirect()->to('/admin/dashboard');
            case 'HRD':
                return redirect()->to('/hrd/dashboard');
            case 'Karyawan':
                return redirect()->to('/karyawan/dashboard');
            default:
                return redirect()->to('/login');
        }
    }

    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}