<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| URI ROUTING
|--------------------------------------------------------------------------
*/
$route['default_controller']   = 'auth/login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
$route['login']         = 'auth/login';
$route['login/proses']  = 'auth/login';
$route['logout']        = 'auth/logout';

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
$route['dashboard'] = 'Dashboard/index';

/*
|--------------------------------------------------------------------------
| PRODUK
|--------------------------------------------------------------------------
*/
$route['produk']                = 'Produk/index';
$route['produk/tambah']         = 'Produk/tambah';
$route['produk/simpan']         = 'Produk/simpan';
$route['produk/edit/(:num)']    = 'Produk/edit/$1';
$route['produk/update/(:num)']  = 'Produk/update/$1';
$route['produk/hapus/(:num)']   = 'Produk/hapus/$1';

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/
$route['pelanggan']                = 'Pelanggan/index';
$route['pelanggan/tambah']         = 'Pelanggan/tambah';
$route['pelanggan/simpan']         = 'Pelanggan/simpan';
$route['pelanggan/edit/(:num)']    = 'Pelanggan/edit/$1';
$route['pelanggan/update/(:num)']  = 'Pelanggan/update/$1';
$route['pelanggan/hapus/(:num)']   = 'Pelanggan/hapus/$1';

/*
|--------------------------------------------------------------------------
| SALES ORDER
|--------------------------------------------------------------------------
*/
$route['sales_order']                        = 'sales_order/index';
$route['sales_order/tambah']                 = 'sales_order/tambah';
$route['sales_order/simpan']                 = 'sales_order/simpan';
$route['sales_order/detail/(:num)']          = 'sales_order/detail/$1';
$route['sales_order/update_status/(:num)']   = 'sales_order/update_status/$1';

/*
|--------------------------------------------------------------------------
| LAPORAN
|--------------------------------------------------------------------------
*/
$route['laporan']        = 'Laporan/index';
$route['laporan/cetak']  = 'Laporan/cetak';