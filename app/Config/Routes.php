<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// Dashboard
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

// Debitur
$routes->group('debitur', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'DebiturController::index');
    $routes->get('tambah', 'DebiturController::tambah');
    $routes->post('simpan', 'DebiturController::simpan');
    $routes->get('edit/(:num)', 'DebiturController::edit/$1');
    $routes->post('update/(:num)', 'DebiturController::update/$1');
    $routes->get('hapus/(:num)', 'DebiturController::hapus/$1');
});

// Motor
$routes->group('motor', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'MotorController::index');
    $routes->get('tambah', 'MotorController::tambah');
    $routes->post('simpan', 'MotorController::simpan');
    $routes->get('edit/(:num)', 'MotorController::edit/$1');
    $routes->post('update/(:num)', 'MotorController::update/$1');
    $routes->get('hapus/(:num)', 'MotorController::hapus/$1');
});

// Kontrak
$routes->group('kontrak', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KontrakController::index');
    $routes->get('tambah', 'KontrakController::tambah');
    $routes->post('simpan', 'KontrakController::simpan');
    $routes->get('edit/(:num)', 'KontrakController::edit/$1');
    $routes->post('update/(:num)', 'KontrakController::update/$1');
    $routes->get('hapus/(:num)', 'KontrakController::hapus/$1');
});

// Laporan
$routes->group('laporan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'LaporanController::index');
    $routes->get('debitur', 'LaporanController::debitur');
    $routes->get('kontrak-aktif', 'LaporanController::kontrakAktif');
    $routes->get('kontrak-selesai', 'LaporanController::kontrakSelesai');
    $routes->get('pdf-debitur', 'LaporanController::pdfDebitur');
    $routes->get('pdf-aktif', 'LaporanController::pdfAktif');
    $routes->get('pdf-selesai', 'LaporanController::pdfSelesai');
});
