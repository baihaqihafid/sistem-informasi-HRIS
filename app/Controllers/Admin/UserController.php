<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

/**
 * Controller: Admin/UserController
 * Mengelola manajemen akun pengguna (CRUD)
 */
class UserController extends BaseController
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    // Daftar semua user
    public function index()
    {
        $data = [
            'judul' => 'Manajemen User',
            'users' => $this->userModel->getUserDenganRole(),
        ];
        return view('admin/user/index', $data);
    }

    // Form tambah user
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah User',
            'roles' => $this->roleModel->findAll(),
        ];
        return view('admin/user/tambah', $data);
    }

    // Simpan user baru
    public function simpan()
    {
        // Aturan validasi
        $rules = [
            'username'     => 'required|min_length[4]|is_unique[users.username]',
            'password'     => 'required|min_length[6]',
            'nama_lengkap' => 'required',
            'role_id'      => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role_id'      => $this->request->getPost('role_id'),
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit($id)
    {
        $data = [
            'judul' => 'Edit User',
            'user'  => $this->userModel->find($id),
            'roles' => $this->roleModel->findAll(),
        ];
        return view('admin/user/edit', $data);
    }

    // Update data user
    public function update($id)
    {
        $updateData = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role_id'      => $this->request->getPost('role_id'),
        ];

        // Jika password diisi, hash dan update
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('/admin/user')->with('success', 'Data user berhasil diperbarui.');
    }

    // Hapus user
    public function hapus($id)
    {
        // Jangan hapus akun yang sedang login
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun yang sedang aktif.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus.');
    }
}