<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AnalitikController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes — LIMS Lite
|--------------------------------------------------------------------------
*/

// Landing
Route::get('/', fn () => redirect()->route('login'));

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/pilih-unit', [AuthController::class, 'pilihUnit'])->name('unit.pilih');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/unit/select', [AuthController::class, 'selectUnit'])->name('unit.select');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Konfigurasi
Route::prefix('konfigurasi')->name('konfigurasi.')->group(function () {
    Route::get('/unit', [KonfigurasiController::class, 'unit'])->name('unit');
    Route::get('/satuan', [KonfigurasiController::class, 'satuan'])->name('satuan');
    Route::get('/jenis-barang', [KonfigurasiController::class, 'jenisBarang'])->name('jenis-barang');
    Route::get('/jenis-pengguna', [KonfigurasiController::class, 'jenisPengguna'])->name('jenis-pengguna');
    Route::get('/pengguna', [KonfigurasiController::class, 'pengguna'])->name('pengguna');
    Route::get('/supplier', [KonfigurasiController::class, 'supplier'])->name('supplier');
});

// Alat & Bahan
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/unit', [BarangController::class, 'berdasarkanUnit'])->name('unit');
    Route::get('/semua', [BarangController::class, 'semua'])->name('semua');
    Route::get('/expire', [BarangController::class, 'expire'])->name('expire');
});

// Transaksi
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/peminjaman', [TransaksiController::class, 'peminjaman'])->name('peminjaman');
    Route::post('/peminjaman', [TransaksiController::class, 'storePeminjaman'])->name('peminjaman.store');
    Route::get('/data-peminjaman', [TransaksiController::class, 'dataPeminjaman'])->name('data-peminjaman');
    Route::get('/supply-baru', [TransaksiController::class, 'supplyBaru'])->name('supply-baru');
    Route::get('/permintaan-baru', [TransaksiController::class, 'permintaanBaru'])->name('permintaan-baru');

    Route::view('/permintaan-personal', 'transaksi.placeholder', ['title' => 'Permintaan Personal'])->name('permintaan-personal');
    Route::view('/permintaan-unit', 'transaksi.placeholder', ['title' => 'Permintaan Unit'])->name('permintaan-unit');
    Route::view('/alat-bahan-masuk', 'transaksi.placeholder', ['title' => 'Alat Bahan Masuk'])->name('alat-bahan-masuk');
    Route::view('/alat-bahan-keluar', 'transaksi.placeholder', ['title' => 'Alat Bahan Keluar'])->name('alat-bahan-keluar');
    Route::view('/transaksi-masuk', 'transaksi.placeholder', ['title' => 'Transaksi Masuk'])->name('transaksi-masuk');
    Route::view('/transaksi-keluar', 'transaksi.placeholder', ['title' => 'Transaksi Keluar'])->name('transaksi-keluar');
});

// Laporan
Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/keluar', [LaporanController::class, 'keluar'])->name('keluar');
    Route::get('/masuk', [LaporanController::class, 'masuk'])->name('masuk');
});

// Analitik
Route::get('/analitik', [AnalitikController::class, 'index'])->name('analitik');
