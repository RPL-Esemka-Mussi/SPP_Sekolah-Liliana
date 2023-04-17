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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\PageController::class, 'login'])->name('login');
    Route::post('/auth', [\App\Http\Controllers\PageController::class, 'auth']);
});

Route::middleware(['level:admin', 'auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\PageController::class, 'index']);
    Route::get('/logout', [\App\Http\Controllers\PageController::class, 'logout']);

    Route::get('/history', [\App\Http\Controllers\PembayaranController::class, 'history']);


    //Route User
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/tambah', [\App\Http\Controllers\UserController::class, 'tambah']);
    Route::post('/user/simpan', [\App\Http\Controllers\UserController::class, 'simpan']);
    Route::get('/user/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update', [\App\Http\Controllers\UserController::class, 'update']);
    Route::get('/user/hapus/{id}', [\App\Http\Controllers\UserController::class, 'hapus']);

    //Route Kelas
    Route::get('/kelas', [\App\Http\Controllers\KelasController::class, 'index']);
    Route::get('/kelas/tambah', [\App\Http\Controllers\KelasController::class, 'tambah']);
    Route::post('/kelas/simpan', [\App\Http\Controllers\KelasController::class, 'simpan']);
    Route::get('/kelas/edit/{id}', [\App\Http\Controllers\KelasController::class, 'edit']);
    Route::post('/kelas/update', [\App\Http\Controllers\KelasController::class, 'update']);
    Route::get('/kelas/hapus/{id}', [\App\Http\Controllers\KelasController::class, 'hapus']);

    //Route SPP
    Route::get('/spp', [\App\Http\Controllers\SPPController::class, 'index']);
    Route::get('/spp/tambah', [\App\Http\Controllers\SPPController::class, 'tambah']);
    Route::post('/spp/simpan', [\App\Http\Controllers\SPPController::class, 'simpan']);
    Route::get('/spp/edit/{id}', [\App\Http\Controllers\SPPController::class, 'edit']);
    Route::post('/spp/update', [\App\Http\Controllers\SPPController::class, 'update']);
    Route::get('/spp/hapus/{id}', [\App\Http\Controllers\SPPController::class, 'hapus']);

    //Route Siswa
    Route::get('/siswa', [\App\Http\Controllers\SiswaController::class, 'index']);
    Route::get('/siswa/tambah', [\App\Http\Controllers\SiswaController::class, 'tambah']);
    Route::post('/siswa/simpan', [\App\Http\Controllers\SiswaController::class, 'simpan']);
    Route::get('/siswa/edit/{id}', [\App\Http\Controllers\SiswaController::class, 'edit']);
    Route::post('/siswa/update', [\App\Http\Controllers\SiswaController::class, 'update']);
    Route::get('/siswa/hapus/{id}', [\App\Http\Controllers\SiswaController::class, 'hapus']);

    //Route Pembayaran
    Route::get('/pembayaran', [\App\Http\Controllers\PembayaranController::class, 'index']);
    Route::get('/pembayaran/transaksi/{id}', [\App\Http\Controllers\PembayaranController::class, 'transaksi']);
    Route::get('/pembayaran/tambah', [\App\Http\Controllers\PembayaranController::class, 'tambah']);
    Route::post('/pembayaran/simpan', [\App\Http\Controllers\PembayaranController::class, 'simpan']);
    Route::get('/pembayaran/edit/{id}', [\App\Http\Controllers\PembayaranController::class, 'edit']);
    Route::post('/pembayaran/update', [\App\Http\Controllers\PembayaranController::class, 'update']);
    Route::get('/pembayaran/hapus/{id}', [\App\Http\Controllers\PembayaranController::class, 'hapus']);
    Route::get('/pembayaran/cetak', [\App\Http\Controllers\PembayaranController::class, 'cetak']);
    Route::get('/pembayaran/cetak/{id}',[ \App\Http\Controllers\PembayaranController::class, 'cetakid']);
    Route::get('/pembayaran/history', [\App\Http\Controllers\PembayaranController::class, 'history']);
    Route::get('/pembayaran/transaksi/history', [\App\Http\Controllers\PembayaranController::class, 'history']);
    Route::get('/pembayaran/transaksi/{id}', [\App\Http\Controllers\PembayaranController::class, 'transaksi']);

    //Route generate laporan
    Route::get('/cetak/semuadata', [\App\Http\Controllers\PembayaranController::class, 'semuadata']);
    Route::get('/cetak/datapersiswa/{id}', [\App\Http\Controllers\PembayaranController::class, 'dataPerSiswa']);

});
