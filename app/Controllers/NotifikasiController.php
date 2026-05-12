<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotifikasiModel;

/**
 * Controller: NotifikasiController
 * Menangani aksi baca notifikasi untuk semua role
 */
class NotifikasiController extends BaseController
{
    protected $notifikasiModel;

    public function __construct()
    {
        $this->notifikasiModel = new NotifikasiModel();
    }

    // Tandai satu notifikasi sebagai sudah dibaca lalu redirect ke URL tujuan
    public function baca($id)
    {
        $notif = $this->notifikasiModel->find($id);

        if ($notif && $notif['user_id'] == session()->get('user_id')) {
            $this->notifikasiModel->update($id, ['status_baca' => 1]);

            if (!empty($notif['url'])) {
                return redirect()->to($notif['url']);
            }
        }

        return redirect()->back();
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function semuaDibaca()
    {
        $this->notifikasiModel->tandaiSemuaSudahDibaca(session()->get('user_id'));
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}