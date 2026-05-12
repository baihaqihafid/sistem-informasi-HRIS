<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $judul ?? 'HRIS' ?> - Sistem Informasi SDM</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    body {
        margin: 0;
        background-color: #f4f6f9;
    }

    /* SIDEBAR */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #2c3e50;
        transition: 0.3s;
        z-index: 999;
    }

    .sidebar.hide {
        left: -250px;
    }

    .sidebar .nav-link {
        color: #bdc3c7;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        color: #fff;
        background-color: #34495e;
    }

    .sidebar .brand {
        color: #fff;
        font-weight: bold;
        padding: 1rem;
        display: block;
        text-decoration: none;
    }

    /* CONTENT */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: 0.3s;
    }

    .main-content.full {
        margin-left: 0;
    }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <a href="#" class="brand border-bottom mb-2 pb-2">
        <i class="bi bi-people-fill"></i> HRIS App
    </a>

    <nav class="nav flex-column px-2">
        <?php $uri = service('uri'); ?>

        <?php if (session()->get('role') == 'Admin'): ?>
            <a class="nav-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>"
               href="<?= base_url('admin/dashboard') ?>">Dashboard</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'user') ? 'active' : '' ?>"
               href="<?= base_url('admin/user') ?>">Manajemen User</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'karyawan') ? 'active' : '' ?>"
               href="<?= base_url('admin/karyawan') ?>">Data Karyawan</a>

        <?php elseif (session()->get('role') == 'HRD'): ?>

            <a class="nav-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>"
               href="<?= base_url('hrd/dashboard') ?>">Dashboard</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'absensi') ? 'active' : '' ?>"
               href="<?= base_url('hrd/absensi') ?>">Data Absensi</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'cuti') ? 'active' : '' ?>"
               href="<?= base_url('hrd/cuti') ?>">Persetujuan Cuti</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'laporan') ? 'active' : '' ?>"
               href="<?= base_url('hrd/laporan') ?>">Laporan</a>

        <?php elseif (session()->get('role') == 'Karyawan'): ?>

            <a class="nav-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>"
               href="<?= base_url('karyawan/dashboard') ?>">Dashboard</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'absensi') ? 'active' : '' ?>"
               href="<?= base_url('karyawan/absensi') ?>">Absensi</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'cuti') ? 'active' : '' ?>"
               href="<?= base_url('karyawan/cuti') ?>">Cuti</a>

            <a class="nav-link <?= ($uri->getSegment(2) == 'profil') ? 'active' : '' ?>"
               href="<?= base_url('karyawan/profil') ?>">Profil</a>
        <?php endif; ?>
    </nav>

    <div class="mt-3 px-2">
        <a href="<?= base_url('logout') ?>" class="nav-link text-danger"
        onclick="localStorage.removeItem('sidebar')">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</div>

<!-- CONTENT -->
<div id="content" class="main-content">

    <!-- TOPBAR -->
    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
        
        <!-- tombol burger -->
        <button class="btn btn-outline-secondary me-2" id="toggleSidebar">
            ☰
        </button>

        <h5 class="mb-0"><?= $judul ?? '' ?></h5>

        <div class="d-flex align-items-center gap-3">
            <?php
                $notifikasiModel = new \App\Models\NotifikasiModel();
                $notifBelumDibaca = $notifikasiModel->notifikasiBelumDibaca(session()->get('user_id'));
                $jumlahNotif = count($notifBelumDibaca);
            ?>

            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm position-relative" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <?php if ($jumlahNotif > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                            <?= $jumlahNotif ?>
                        </span>
                    <?php endif; ?>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" style="min-width:300px">
                    <li class="px-3 py-2 fw-bold border-bottom">Notifikasi</li>

                    <?php if (empty($notifBelumDibaca)): ?>
                        <li class="px-3 py-2 text-muted small">Tidak ada notifikasi.</li>
                    <?php else: ?>
                        <?php foreach ($notifBelumDibaca as $notif): ?>
                            <li>
                                <a href="<?= base_url('notifikasi/baca/' . $notif['id']) ?>" class="dropdown-item small">
                                    <?= esc($notif['pesan']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <span class="small text-muted">
                <i class="bi bi-person-circle"></i>
                <?= session()->get('nama_lengkap') ?> (<?= session()->get('role') ?>)
            </span>
        </div>
    </div>

    <!-- KONTEN -->
    <?= $this->renderSection('konten') ?>

</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");

    // 🔥 ambil state dari localStorage
    let sidebarState = localStorage.getItem("sidebar");

    if (sidebarState === "hide") {
        sidebar.classList.add("hide");
        content.classList.add("full");
    } else if (sidebarState === "show") {
        sidebar.classList.remove("hide");
        content.classList.remove("full");
    } else {
        // default pertama kali (mobile)
        if (window.innerWidth <= 768) {
            sidebar.classList.add("hide");
            content.classList.add("full");
        }
    }

    // klik tombol
    btn.addEventListener("click", function () {
        sidebar.classList.toggle("hide");
        content.classList.toggle("full");

        // 🔥 simpan state
        if (sidebar.classList.contains("hide")) {
            localStorage.setItem("sidebar", "hide");
        } else {
            localStorage.setItem("sidebar", "show");
        }
    });
});
</script>

<script>
document.querySelectorAll("#sidebar .nav-link").forEach(link => {
    link.addEventListener("click", function () {
        if (window.innerWidth <= 768) {
            // ❌ jangan animasi di sini
            // ✔ cukup simpan state saja
            localStorage.setItem("sidebar", "hide");
        }
    });
});
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>