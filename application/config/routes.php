<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                    = 'auth';

$route['login']                                 = 'auth/index';
$route['logout']                                = 'auth/logout';
$route['blocked']                               = 'auth/blocked';

// Admin
// Dashboard
$route['admin']                                 = 'admin/index';
// Barang
$route['admin/barang']                          = 'admin/barang';
$route['admin/barang/add']                      = 'admin/barang_add'; // Kalau tidak pakai modal, nambah route ini
$route['admin/barang-save']                     = 'admin/barang_save';
// Kendaraan
$route['admin/kendaraan']                       = 'admin/kendaraan';
$route['admin/kendaraan/add']                   = 'admin/kendaraan_add'; // Kalau tidak pakai modal, nambah route ini
$route['admin/kendaraan-save']                  = 'admin/kendaraan_save';
// Ruangan
$route['admin/ruangan']                         = 'admin/ruangan';
$route['admin/ruangan/add']                     = 'admin/ruangan_add'; // Kalau tidak pakai modal, nambah route ini
$route['admin/ruangan-save']                    = 'admin/ruangan_save';
// Menampilkan permintaan pinjam barang harian, pulang
$route['admin/permintaan']                      = 'admin/permintaan';
// Aksi Approve
$route['admin/approve-harian/(:num)']           = 'admin/approve_harian/$1';
$route['admin/approve-pulang/(:num)']           = 'admin/approve_pulang/$1';
// Form Tolak
$route['admin/penolakan-harian/(:num)']         = 'admin/penolakan_harian/$1';
$route['admin/penolakan-pulang/(:num)']         = 'admin/penolakan_pulang/$1';
// Aksi Tolak
$route['admin/tolak-harian/(:num)']             = 'admin/tolak_harian/$1';
$route['admin/tolak-pulang/(:num)']             = 'admin/tolak_pulang/$1';
// Menampilkan barang harian, pulang, dan ruangan yg sedang dipinjam
$route['admin/peminjaman']                      = 'admin/peminjaman';
// Pengembalian
$route['admin/pengembalian/(:num)/barang']      = 'admin/pengembalian_barang/$1';
// Peminjam
$route['admin/peminjam']                        = 'admin/peminjam';
$route['admin/peminjam/add']                    = 'admin/peminjam_add'; // Kalau tidak pakai modal, nambah route ini
$route['admin/peminjam-save']                   = 'admin/peminjam_save';
// Supir
$route['admin/supir']                           = 'admin/supir';
$route['admin/supir/add']                       = 'admin/supir_add'; // Kalau tidak pakai modal, nambah route ini
$route['admin/supir-save']                      = 'admin/supir_save';
// Laporan/Riwayat Peminjaman approve + reject
$route['admin/peminjaman-harian']               = 'admin/peminjaman_harian';
$route['admin/peminjaman-pulang']               = 'admin/peminjaman_pulang';
$route['admin/peminjaman-kendaraan']            = 'admin/peminjaman_kendaraan';
$route['admin/peminjaman-ruangan']              = 'admin/peminjaman_ruangan';
// profile
$route['admin/profile']                         = 'admin/profile';
$route['admin/profile-edit']                    = 'admin/profile_edit';
$route['admin/profile-ubahpassword']            = 'admin/profile_changepassword';
// End of Admin

// User
// Dashboard
$route['user']                                  = 'user/index';
// Untuk dipinjam
$route['user/barang']                           = 'user/barang'; // 2 button, harian atau pulang
$route['user/kendaraan']                        = 'user/kendaraan';
$route['user/ruangan']                          = 'user/ruangan';
// Halaman Form Peminjaman
$route['user/peminjaman/(:num)/pulang']         = 'user/peminjaman_pulang/$1';
$route['user/peminjaman/(:num)/kendaraan']      = 'user/peminjaman_kendaraan/$1';
$route['user/peminjaman/(:num)/ruangan']        = 'user/peminjaman_ruangan/$1';
// Aksi/Save Pinjam
$route['user/pinjam/(:num)/harian']             = 'user/pinjam_harian/$1';
$route['user/pinjam/(:num)/pulang']             = 'user/pinjam_pulang/$1';
$route['user/pinjam/(:num)/kendaraan']          = 'user/pinjam_kendaraan/$1';
$route['user/pinjam/(:num)/ruangan']            = 'user/pinjam_ruangan/$1';
// Menampilkan semua yg sedang dipinjam. Aksi diatas redirect ke sini
$route['user/peminjaman']                       = 'user/peminjaman';
// Riwayat Peminjaman & Pengembalian
$route['user/riwayat-peminjaman']               = 'user/riwayat_peminjaman';
$route['user/riwayat-peminjaman-barang']        = 'user/riwayat_peminjaman_barang';
$route['user/riwayat-peminjaman-kendaraan']     = 'user/riwayat_peminjaman_kendaraan';
$route['user/riwayat-peminjaman-ruangan']       = 'user/riwayat_peminjaman_ruangan';
$route['user/riwayat-peminjaman-ditolak']       = 'user/riwayat_peminjaman_ditolak';

$route['user/riwayat-pengembalian-barang']      = 'user/riwayat_pengembalian_barang';
$route['user/riwayat-pengembalian-ruangan']     = 'user/riwayat_pengembalian_ruangan';
// Profile
$route['user/profile']                          = 'user/profile';
$route['user/profile-ubahpassword']             = 'user/profile_changepassword';
// End of User

// Kepsek
// Dashboard
$route['kepsek']                          = 'kepsek/index';
// Menampilkan permintaan pinjam barang pulang, kendaraan, dan ruangan
$route['kepsek/permintaan']                     = 'kepsek/permintaan';
// Aksi Approve
$route['kepsek/approve-pulang/(:num)']          = 'kepsek/approve_pulang/$1';
$route['kepsek/approve-kendaraan/(:num)']       = 'kepsek/approve_kendaraan/$1';
$route['kepsek/approve-ruangan/(:num)']         = 'kepsek/approve_ruangan/$1';
// Form Tolak
$route['kepsek/penolakan-pulang/(:num)']        = 'kepsek/penolakan_pulang/$1';
$route['kepsek/penolakan-kendaraan/(:num)']     = 'kepsek/penolakan_kendaraan/$1';
$route['kepsek/penolakan-ruangan/(:num)']       = 'kepsek/penolakan_ruangan/$1';
// Aksi Tolak
$route['kepsek/tolak-pulang/(:num)']            = 'kepsek/tolak_pulang/$1';
$route['kepsek/tolak-kendaraan/(:num)']         = 'kepsek/tolak_kendaraan/$1';
$route['kepsek/tolak-ruangan/(:num)']           = 'kepsek/tolak_ruangan/$1';
// Menampilkan barang pulang, kendaraan, dan ruangan yg sedang dipinjam
$route['kepsek/peminjaman']                     = 'kepsek/peminjaman';
// Laporan/Riwayat Peminjaman approve + reject
$route['kepsek/peminjaman-pulang']              = 'kepsek/peminjaman_pulang';
$route['kepsek/peminjaman-kendaraan']           = 'kepsek/peminjaman_kendaraan';
$route['kepsek/peminjaman-ruangan']             = 'kepsek/peminjaman_ruangan';
// Profile
$route['kepsek/profile']                        = 'kepsek/profile';
$route['kepsek/profile-ubahpassword']           = 'kepsek/profile_changepassword';
// End of Kepsek

// Pegawai
// Dashboard
$route['pegawai']                         = 'pegawai/index';
// Menampilkan permintaan pinjam kendaraan, dan ruangan
$route['pegawai/permintaan']                    = 'pegawai/permintaan';
// Aksi Approve
$route['pegawai/approve-kendaraan/(:num)']      = 'pegawai/approve_kendaraan/$1';
$route['pegawai/approve-ruangan/(:num)']        = 'pegawai/approve_ruangan/$1';
// Form Tolak
$route['pegawai/penolakan-kendaraan/(:num)']    = 'pegawai/penolakan_kendaraan/$1';
$route['pegawai/penolakan-ruangan/(:num)']      = 'pegawai/penolakan_ruangan/$1';
// Aksi Tolak
$route['pegawai/tolak-kendaraan/(:num)']        = 'pegawai/tolak_kendaraan/$1';
$route['pegawai/tolak-ruangan/(:num)']          = 'pegawai/tolak_ruangan/$1';
// Menampilkan kendaraan, dan ruangan yg sedang dipinjam
$route['pegawai/peminjaman']                    = 'pegawai/peminjaman';
// Laporan/Riwayat Peminjaman approve + reject
$route['pegawai/peminjaman-kendaraan']          = 'pegawai/peminjaman_kendaraan';
$route['pegawai/peminjaman-ruangan']            = 'pegawai/peminjaman_ruangan';
//pengembalian
$route['pegawai/pengembalian/(:num)/kendaraan'] = 'pegawai/pengembalian_kendaraan/$1';
// profile
$route['pegawai/profile']                       = 'pegawai/profile';
$route['pegawai/profile-ubahpassword']          = 'pegawai/profile_changepassword';
// End of Pegawai

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
