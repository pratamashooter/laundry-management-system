<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ========================================== SISTEM LOGIN =========================================
Route::post('/registrasi_awal', 'SistemLoginController@registrasiAwal');
Route::get('/login', 'SistemLoginController@halamanLogin')->name('login');
Route::post('/login_verifikasi', 'SistemLoginController@verifikasiLogin');
Route::get('/logout', 'SistemLoginController@prosesLogout');
// =================================================================================================

// =============================== AKSES ADMIN, KASIR, DAN PELANGGAN ===============================
Route::group(['middleware' => ['auth', 'checkRole:admin,kasir,non_member,member']], function(){
// => Fitur Cari Halaman
	Route::get('/cari_halaman/{kata}', 'FiturCariController@cariHalaman');
// => Halaman Dashboard
	Route::get('/dashboard', 'HalDashboardController@halamanDashboard');
// => Hubungan Transaksi
	Route::get('/pdf_transaksi/{id}', 'HalTransaksiController@pdfTransaksi');
	Route::get('/ubah_status_transaksi/{status}/{id}', 'HalTransaksiController@ubahStatusTransaksi');
});
// =================================================================================================

// ===================================== AKSES ADMIN DAN KASIR =====================================
Route::group(['middleware' => ['auth', 'checkRole:admin,kasir']], function(){
// => Halaman Profil
	Route::get('/kelola_profil', 'HalProfilController@halamanProfil');
	Route::post('/update_profil', 'HalProfilController@updateProfil');
	Route::post('/ubah_password/{id}', 'HalProfilController@ubahPassword');
// => Halaman Pelanggan
	Route::get('/registrasi_pelanggan', 'HalPelangganController@registrasiPelanggan');
	Route::get('/kelola_transaksi', 'HalPelangganController@halamanTransaksi');
	Route::get('/kelola_pelanggan', 'HalPelangganController@halamanPelanggan');
	Route::get('/detail_pelanggan_member/{id}', 'HalPelangganController@detailPelangganMember');
	Route::get('/detail_pelanggan_non_member/{id}', 'HalPelangganController@detailPelangganNonMember');
	Route::get('/layanan_member/{id}', 'HalPelangganController@halamanLayananMember');
	Route::get('/sort_outlet_tabel_kiloan/{id}', 'HalPelangganController@sortOutletTabelKiloan');
	Route::get('/sort_outlet_tabel_satuan/{id}', 'HalPelangganController@sortOutletTabelSatuan');
	Route::post('/simpan_pelanggan', 'HalPelangganController@simpanPelanggan');
	Route::post('/simpan_pesanan', 'HalPelangganController@simpanPesanan');
	Route::get('/lihat_paket_kilo_member/{id}', 'HalPelangganController@lihatPaketKiloMember');
	Route::get('/lihat_paket_satu_member/{id}', 'HalPelangganController@lihatPaketSatuMember');
	Route::get('/update_status_transaksi/{id}/{status}', 'HalPelangganController@updateStatusTransaksi');
	Route::get('/hapus_pesanan_kilo/{id}', 'HalPelangganController@hapusPesananKilo');
	Route::get('/hapus_pesanan_satu/{id}', 'HalPelangganController@hapusPesananSatu');
	Route::get('/hapus_pelanggan/{id}', 'HalPelangganController@hapusPelanggan');
	Route::get('/pdf_pelanggan/{id}', 'HalPelangganController@pdfPelanggan');
// => Halaman Transaksi
	Route::get('/lihat_transaksi_selesai/{id}', 'HalTransaksiController@lihatTransaksiSelesai');
	Route::get('/lihat_transaksi_diantar/{id}', 'HalTransaksiController@lihatTransaksiDiantar');
	Route::get('/lihat_transaksi_diambil/{id}', 'HalTransaksiController@lihatTransaksiDiambil');
	Route::post('/bayar_pesanan', 'HalTransaksiController@bayarPesanan');
// => Halaman Laporan
	Route::get('/laporan_transaksi', 'HalLaporanController@halamanLaporanTransaksi');
	Route::get('/laporan_pegawai', 'HalLaporanController@halamanLaporanPegawai');
	Route::get('/laporan_pegawai_riwayat/{id}', 'HalLaporanController@halamanLaporanPegawaiRiwayat');
	Route::post('/filter_laporan_transaksi', 'HalLaporanController@filterLaporanTransaksi');
	Route::post('/filter_laporan_pegawai/{id}', 'HalLaporanController@filterLaporanPegawai');
	Route::post('/pdf_laporan_transaksi', 'HalLaporanController@pdfLaporanTransaksi');
	Route::post('/pdf_laporan_pegawai/{id}', 'HalLaporanController@pdfLaporanPegawai');
});
// =================================================================================================

// ========================================== AKSES ADMIN ==========================================
Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){
// => Halaman Pengguna
	Route::get('/kelola_pengguna', 'HalPenggunaController@halamanPengguna');
	Route::get('/tambah_pengguna', 'HalPenggunaController@tambahPengguna');
	Route::post('/simpan_pengguna', 'HalPenggunaController@simpanPengguna');
	Route::get('/lihat_pengguna/{id}', 'HalPenggunaController@lihatPengguna');
	Route::get('/edit_pengguna/{id}', 'HalPenggunaController@editPengguna');
	Route::post('/update_pengguna/{id}', 'HalPenggunaController@updatePengguna');
	Route::get('/hapus_pengguna/{id}', 'HalPenggunaController@hapusPengguna');
// => Halaman Outlet
	Route::get('/kelola_outlet', 'HalOutletController@halamanOutlet');
	Route::get('/tambah_outlet', 'HalOutletController@tambahOutlet');
	Route::post('/simpan_outlet', 'HalOutletController@simpanOutlet');
	Route::get('/lihat_outlet/{id}', 'HalOutletController@lihatOutlet');
	Route::get('/edit_outlet/{id}', 'HalOutletController@editOutlet');
	Route::post('/update_outlet/{id}', 'HalOutletController@updateOutlet');
	Route::get('/hapus_outlet/{id}', 'HalOutletController@hapusOutlet');
// => Halaman Paket
	Route::get('/kelola_paket', 'HalPaketController@halamanPaket');
	Route::get('/tambah_paket_kiloan', 'HalPaketController@tambahPaketKiloan');
	Route::get('/tambah_paket_satuan', 'HalPaketController@tambahPaketSatuan');
	Route::post('/simpan_paket_kiloan', 'HalPaketController@simpanPaketKiloan');
	Route::post('/simpan_paket_satuan', 'HalPaketController@simpanPaketSatuan');
	Route::get('/lihat_paket_kiloan/{id}', 'HalPaketController@lihatPaketKiloan');
	Route::get('/lihat_paket_satuan/{id}', 'HalPaketController@lihatPaketSatuan');
	Route::get('/edit_paket_kiloan/{id}', 'HalPaketController@editPaketKiloan');
	Route::get('/edit_paket_satuan/{id}', 'HalPaketController@editPaketSatuan');
	Route::post('/update_paket_kiloan/{id}', 'HalPaketController@updatePaketKiloan');
	Route::post('/update_paket_satuan/{id}', 'HalPaketController@updatePaketSatuan');
	Route::get('/hapus_paket_kiloan/{id}', 'HalPaketController@hapusPaketKiloan');
	Route::get('/hapus_paket_satuan/{id}', 'HalPaketController@hapusPaketSatuan');
});
// =================================================================================================

// ======================================== AKSES PELANGGAN ========================================
Route::group(['middleware' => ['auth', 'checkRole:member,non_member']], function(){
// => Dashboard Pelanggan
	Route::get('/data_outlet_dashboard/{id}', 'HalDashboardController@dashboardPelanggan');
	Route::get('/outlet_tabel_kiloan/{id}', 'HalDashboardController@outletTabelKiloan');
	Route::get('/outlet_tabel_satuan/{id}', 'HalDashboardController@outletTabelSatuan');
	Route::post('/update_profil_pelanggan', 'HalDashboardController@updateProfilPelanggan');
	Route::get('/pesanan_saya', 'HalPesananPelangganController@halamanPesananPelanggan');
	Route::get('/lihat_pesanan_pelanggan/{id}', 'HalPesananPelangganController@lihatPesananPelanggan');
});
// =================================================================================================

// ====================================== Sistem Login Bawaan ======================================
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// =================================================================================================