<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginAction');

$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/mahasiswa', 'MahasiswaController::index');
$routes->get('/admin/arsip', 'ArsipController::index');
$routes->get('/admin/kategori', 'KategoriController::index');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin/mahasiswa/tambah', 'MahasiswaController::tambah');
$routes->post('/admin/mahasiswa/tambah', 'MahasiswaController::simpan');

$routes->get('/admin/kategori/tambah', 'KategoriController::tambah');
$routes->post('/admin/kategori/tambah', 'KategoriController::simpan');

$routes->get('/admin/arsip/tambah', 'ArsipController::tambah');
$routes->post('/admin/arsip/tambah', 'ArsipController::simpan');

$routes->get('/admin/mahasiswa/hapus/(:num)', 'MahasiswaController::hapus/$1');

$routes->get('/admin/arsip/hapus/(:num)', 'ArsipController::hapus/$1');

$routes->get('/admin/kategori/hapus/(:num)', 'KategoriController::hapus/$1');

$routes->get('/admin/mahasiswa/edit/(:num)', 'MahasiswaController::edit/$1');
$routes->post('/admin/mahasiswa/edit/(:num)', 'MahasiswaController::update/$1');

$routes->get('/admin/kategori/edit/(:num)', 'KategoriController::edit/$1');
$routes->post('/admin/kategori/edit/(:num)', 'KategoriController::update/$1');

$routes->get('/admin/arsip/edit/(:num)', 'ArsipController::edit/$1');
$routes->post('/admin/arsip/edit/(:num)', 'ArsipController::update/$1');

$routes->get('/admin', 'AdminController::dashboard');
$routes->get('/admin/arsip', 'ArsipController::index');
