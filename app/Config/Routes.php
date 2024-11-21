<?php

use App\Controllers\Produk;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/Produk','Produk::index');

$routes->get('/produk/tampil', 'Produk::tampil_produk');
$routes->get('/produk/getProduk/(:num)', 'Produk::getProduk/$1');
$routes->post('produk/update_produk/(:num)', 'Produk::update_produk/$1');
$routes->post('/produk/simpan', 'Produk::simpan_produk');
$routes->post('/produk/hapus/(:num)', 'Produk::hapus_produk/$1');


$routes->get('/Pelanggan','Pelanggan::index');

$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');
$routes->get('/pelanggan/getPelanggan/(:num)', 'Pelanggan::getPelanggan/$1');
$routes->post('/pelanggan/update_pelanggan/(:num)', 'Pelanggan::update_pelanggan/$1');
$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');
$routes->post('/pelanggan/hapus/(:num)', 'Pelanggan::hapus_pelanggan/$1');