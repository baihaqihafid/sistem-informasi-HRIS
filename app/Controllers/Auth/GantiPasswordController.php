<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Controller: GantiPasswordController
 * Semua pengguna dapat mengganti password akun mereka sendiri
 */
class GantiPasswordController extends BaseController
{
    public function index()
    {
        return view('auth/ganti_password', ['judul' => 'Ganti Password']);
    }

    public function proses()
    {
        $userModel = new UserModel();
        $userId    = session()->get('user_id');
        $user      = $userModel->find($userId);

        // Verifikasi password lama
        if (!password_verify($this->request->getPost('password_lama'), $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        $passwordBaru   = $this->request->getPost('password_baru');
        $passwordKonfirm = $this->request->getPost('password_konfirmasi');

        if ($passwordBaru !== $passwordKonfirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
        }

        if (strlen($passwordBaru) < 6) {
            return redirect()->back()->with('error', 'Password baru minimal 6 karakter.');
        }

        $userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}