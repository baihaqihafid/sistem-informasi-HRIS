<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ============================
// HALAMAN PUBLIK
// ============================
$routes->get('/', 'Auth\LoginController::index');
$routes->get('login', 'Auth\LoginController::index');
$routes->post('login/proses', 'Auth\LoginController::proses');
$routes->get('logout', 'Auth\LoginController::logout');

// ============================
// ADMIN
// ============================
$routes->group('admin', ['filter' => 'auth:Admin'], function ($routes) {

    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('user', 'Admin\UserController::index');
    $routes->get('user/tambah', 'Admin\UserController::tambah');
    $routes->post('user/simpan', 'Admin\UserController::simpan');
    $routes->get('user/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('user/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('user/hapus/(:num)', 'Admin\UserController::hapus/$1');

    $routes->get('karyawan', 'Admin\KaryawanController::index');
    $routes->get('karyawan/tambah', 'Admin\KaryawanController::tambah');
    $routes->post('karyawan/simpan', 'Admin\KaryawanController::simpan');
    $routes->get('karyawan/edit/(:num)', 'Admin\KaryawanController::edit/$1');
    $routes->post('karyawan/update/(:num)', 'Admin\KaryawanController::update/$1');
    $routes->get('karyawan/hapus/(:num)', 'Admin\KaryawanController::hapus/$1');
    $routes->get('karyawan/detail/(:num)', 'Admin\KaryawanController::detail/$1');
});

// ============================
// HRD
// ============================
$routes->group('hrd', ['filter' => 'auth:HRD'], function ($routes) {

    $routes->get('dashboard', 'Hrd\DashboardController::index');

    $routes->get('absensi', 'Hrd\AbsensiController::index');
    $routes->get('absensi/tambah', 'Hrd\AbsensiController::tambah');
    $routes->post('absensi/simpan', 'Hrd\AbsensiController::simpan');
    $routes->get('absensi/edit/(:num)', 'Hrd\AbsensiController::edit/$1');
    $routes->post('absensi/update/(:num)', 'Hrd\AbsensiController::update/$1');
    $routes->get('absensi/hapus/(:num)', 'Hrd\AbsensiController::hapus/$1');

    $routes->get('cuti', 'Hrd\CutiController::index');
    $routes->get('cuti/detail/(:num)', 'Hrd\CutiController::detail/$1');
    $routes->post('cuti/setujui/(:num)', 'Hrd\CutiController::setujui/$1');
    $routes->post('cuti/tolak/(:num)', 'Hrd\CutiController::tolak/$1');

    $routes->get('cuti/edit/(:num)', 'Hrd\CutiController::edit/$1');
    $routes->post('cuti/update/(:num)', 'Hrd\CutiController::update/$1');
    $routes->get('cuti/hapus/(:num)', 'Hrd\CutiController::hapus/$1');

    $routes->get('laporan', 'Hrd\LaporanController::index');
    $routes->get('laporan/absensi', 'Hrd\LaporanController::absensi');
    $routes->get('laporan/cuti', 'Hrd\LaporanController::cuti');
    $routes->get('laporan/exportPdfAbsensi', 'Hrd\LaporanController::exportPdfAbsensi');
});

// ============================
// KARYAWAN
// ============================
$routes->group('karyawan', ['filter' => 'auth:Karyawan'], function ($routes) {

    $routes->get('dashboard', 'Karyawan\DashboardController::index');

    $routes->get('absensi', 'Karyawan\AbsensiController::index');
    $routes->post('absensi/masuk', 'Karyawan\AbsensiController::masuk');
    $routes->post('absensi/keluar', 'Karyawan\AbsensiController::keluar');

    $routes->get('cuti', 'Karyawan\CutiController::index');
    $routes->get('cuti/ajukan', 'Karyawan\CutiController::ajukan');
    $routes->post('cuti/simpan', 'Karyawan\CutiController::simpan');

    $routes->get('profil', 'Karyawan\ProfilController::index');
    $routes->post('profil/update', 'Karyawan\ProfilController::update');
});

// ============================
// DASHBOARD REDIRECT
// ============================
$routes->get('dashboard', 'Auth\LoginController::dashboard', ['filter' => 'auth']);

// ============================
// LAINNYA
// ============================
$routes->get('notifikasi/baca/(:num)', 'NotifikasiController::baca/$1', ['filter' => 'auth']);
$routes->get('notifikasi/semua', 'NotifikasiController::semuaDibaca', ['filter' => 'auth']);

$routes->get('ganti-password', 'Auth\GantiPasswordController::index', ['filter' => 'auth']);
$routes->post('ganti-password/proses', 'Auth\GantiPasswordController::proses', ['filter' => 'auth']);