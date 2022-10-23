<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Karyawan\DataController;
use App\Http\Controllers\Karyawan\UpahController;
use App\Http\Controllers\Kasir\PenjualanController;
use App\Http\Controllers\Kasir\TampilanController;
use App\Http\Controllers\Kasir\CustomController;
use App\Http\Controllers\Barang\GudangController;
use App\Http\Controllers\Akun\ProfilController;
use App\Http\Controllers\Akun\AktivitasController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\PengingatController;
use App\Http\Controllers\ArsipController;

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

//Landing.
Route::get('/', [LandingController::class, 'index'])->name('welcome');
Route::post('/login/{role}', [LandingController::class, 'login']);

//Profil.
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::post('/profil/edit', [ProfilController::class, 'edit_akun']);
Route::post('/profil/status/{status}', [ProfilController::class, 'edit_status']);
Route::post('/profil/edit_foto', [ProfilController::class, 'edit_foto']);
Route::post('/profil/reset_foto', [ProfilController::class, 'reset_foto']);
Route::post('/profil/sign_out', [ProfilController::class, 'sign_out']);

//Aktivitas.
Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas');
Route::post('/aktivitas/delete/{id}', [AktivitasController::class, 'delete_aktivitas']);
Route::post('/aktivitas/delete_all_aktivitas', [AktivitasController::class, 'delete_all_aktivitas']);

//Dashboard.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/filter/{setting}', [DashboardController::class, 'filter']);

//Rak
Route::get('/rak/{id}', [RakController::class, 'index']);
Route::get('/getBarangRak/{id}', [RakController::class, 'getBarangRak']);
Route::post('/rak/delete_barang/{id}', [RakController::class, 'delete_barang']);
Route::post('/rak/delete_rak/{id}', [RakController::class, 'delete_rak']);
Route::post('/rak/edit_barang/{id}', [RakController::class, 'edit_barang']);
Route::post('/rak/edit_rak/{id}', [RakController::class, 'edit_rak']);
Route::post('/rak/edit_foto/{id}', [RakController::class, 'edit_foto']);
Route::post('/rak/tambah_rak', [RakController::class, 'tambah_rak']);
Route::post('/rak/tambah_barang_rak', [RakController::class, 'tambah_barang_rak']);

//Riwayat
Route::get('/riwayat', [RiwayatController::class, 'index']);

//Karyawan
Route::get('/karyawan/data', [DataController::class, 'index']);
Route::post('/karyawan/data/delete_karyawan/{id}', [DataController::class, 'delete_karyawan']);
Route::post('/karyawan/data/edit_karyawan/{id}', [DataController::class, 'edit_karyawan']);
Route::post('/karyawan/data/edit_foto/{id}', [DataController::class, 'edit_foto']);
Route::post('/karyawan/data/reset_foto/{id}', [DataController::class, 'reset_foto']);
Route::post('/karyawan/data/tambah_karyawan', [DataController::class, 'tambah_karyawan']);
Route::post('/karyawan/data/tambah_jabatan', [DataController::class, 'tambah_jabatan']);
Route::post('/karyawan/data/unpin/{id}', [DataController::class, 'unpin']);
Route::post('/karyawan/data/pin/{id}', [DataController::class, 'pin']);

Route::get('/karyawan/upah', [UpahController::class, 'index']);
Route::post('/karyawan/upah/unpin/{id}', [UpahController::class, 'unpin']);
Route::post('/karyawan/upah/pin/{id}', [UpahController::class, 'pin']);
Route::post('/karyawan/upah/edit_upah/{id}', [UpahController::class, 'edit_upah']);

//Kalender
Route::get('/kalender', [KalenderController::class, 'index']);
Route::post('/kalender/filter', [KalenderController::class, 'filter']);

//Pengingat
Route::get('/pengingat', [PengingatController::class, 'index']);
Route::get('/pengingat/get_days_around', [PengingatController::class, 'get_days_around']);
Route::post('/pengingat/filterday', [PengingatController::class, 'set_day_filter']);
Route::post('/pengingat/view_pengingat', [PengingatController::class, 'view_pengingat']);
Route::post('/pengingat/tambah_kegiatan', [PengingatController::class, 'tambah_kegiatan']);
Route::post('/pengingat/edit_kegiatan/{id}', [PengingatController::class, 'edit_kegiatan']);
Route::post('/pengingat/hapus_hour_kegiatan/{id}', [PengingatController::class, 'hapus_hour_kegiatan']);
Route::post('/pengingat/hapus_kegiatan/{id}', [PengingatController::class, 'hapus_kegiatan']);

//Arsip
Route::get('/arsip', [ArsipController::class, 'index']);
Route::get('/getRelasiArsip', [ArsipController::class, 'getRelasiArsip']);
Route::post('/arsip/view/{id}', [ArsipController::class, 'view']);

//Kasir
//Penjualan
Route::get('/kasir/penjualan', [PenjualanController::class, 'index']);
Route::post('/kasir/penjualan/tambah_kasir', [PenjualanController::class, 'add_kasir']);
Route::post('/kasir/penjualan/tambah_karyawan/{id}', [PenjualanController::class, 'add_karyawan_kasir']);
Route::post('/kasir/penjualan/hapus_kasir/{id}', [PenjualanController::class, 'delete_kasir']);
Route::post('/kasir/penjualan/hapus_karyawan/{id}', [PenjualanController::class, 'delete_karyawan_kasir']);
Route::post('/kasir/penjualan/edit_kasir/{id}', [PenjualanController::class, 'edit_kasir']);
Route::post('/kasir/penjualan/unpin/{id}', [PenjualanController::class, 'unpin']);
Route::post('/kasir/penjualan/pin/{id}', [PenjualanController::class, 'pin']);

//Tampilan
Route::get('/kasir/tampilan', [TampilanController::class, 'index']);
Route::post('/kasir/tampilan/tambah_tampilan', [TampilanController::class, 'tambah_tampilan']);
Route::post('/kasir/tampilan/hapus_tampilan/{id}', [TampilanController::class, 'hapus_tampilan']);

//Custom
Route::get('/kasir/tampilan/custom/{id}', [CustomController::class, 'index']);
Route::get('/kasir/tampilan/getTampilan/{id}', [CustomController::class, 'getTampilan']);
Route::post('/kasir/tampilan/edit_tampilan/{id}', [CustomController::class, 'edit_tampilan']);
Route::post('/kasir/tampilan/tambah_container/{id}', [CustomController::class, 'tambah_container']);
Route::post('/kasir/tampilan/hapus_container/{id}', [CustomController::class, 'hapus_container']);
Route::post('/kasir/tampilan/edit_tampilan_title/{id}', [CustomController::class, 'edit_tampilan_title']);
Route::post('/kasir/tampilan/pilih_fitur/{id}', [CustomController::class, 'pilih_fitur']);

//Barang
Route::get('/barang/gudang', [GudangController::class, 'index']);
Route::post('/barang/gudang/tambah_barang', [GudangController::class, 'add_barang']);
Route::post('/barang/gudang/tambah_kategori', [GudangController::class, 'add_kategori']);
Route::post('/barang/gudang/edit_barang/{id}', [GudangController::class, 'edit_barang']);
Route::post('/barang/gudang/edit_harga/{id}', [GudangController::class, 'edit_harga']);
Route::post('/barang/gudang/edit_gambar/{id}', [GudangController::class, 'edit_gambar']);
Route::post('/barang/gudang/delete_barang/{id}', [GudangController::class, 'delete_barang']);
Route::post('/barang/gudang/unpin/{id}', [GudangController::class, 'unpin']);
Route::post('/barang/gudang/pin/{id}', [GudangController::class, 'pin']);