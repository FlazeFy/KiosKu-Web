<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RiwayatController;

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
Route::get('/', [LandingController::class, 'index']);
Route::post('/login/{role}', [LandingController::class, 'login']);

//Dashboard.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/filter/{setting}', [DashboardController::class, 'filter']);

//Rak
Route::get('/rak/{id}', [RakController::class, 'index']);
Route::post('/rak/delete_barang/{id}', [RakController::class, 'delete_barang']);
Route::post('/rak/delete_rak/{id}', [RakController::class, 'delete_rak']);
Route::post('/rak/edit_barang/{id}', [RakController::class, 'edit_barang']);
Route::post('/rak/edit_rak/{id}', [RakController::class, 'edit_rak']);
Route::post('/rak/tambah_rak', [RakController::class, 'tambah_rak']);
Route::post('/rak/tambah_barang_rak/{id}', [RakController::class, 'tambah_barang_rak']);

//Riwayat
Route::get('/riwayat', [RiwayatController::class, 'index']);