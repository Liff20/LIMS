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
    Route::post('/unit', [KonfigurasiController::class, 'unitStore'])->name('unit.store');
    Route::put('/unit/{unit}', [KonfigurasiController::class, 'unitUpdate'])->name('unit.update');
    Route::delete('/unit/{unit}', [KonfigurasiController::class, 'unitDestroy'])->name('unit.destroy');

    Route::get('/satuan', [KonfigurasiController::class, 'satuan'])->name('satuan');
    Route::post('/satuan', [KonfigurasiController::class, 'satuanStore'])->name('satuan.store');
    Route::put('/satuan/{satuan}', [KonfigurasiController::class, 'satuanUpdate'])->name('satuan.update');
    Route::delete('/satuan/{satuan}', [KonfigurasiController::class, 'satuanDestroy'])->name('satuan.destroy');

    Route::get('/jenis-barang', [KonfigurasiController::class, 'jenisBarang'])->name('jenis-barang');
    Route::post('/jenis-barang', [KonfigurasiController::class, 'jenisBarangStore'])->name('jenis-barang.store');
    Route::put('/jenis-barang/{jenisBarang}', [KonfigurasiController::class, 'jenisBarangUpdate'])->name('jenis-barang.update');
    Route::delete('/jenis-barang/{jenisBarang}', [KonfigurasiController::class, 'jenisBarangDestroy'])->name('jenis-barang.destroy');

    Route::get('/jenis-pengguna', [KonfigurasiController::class, 'jenisPengguna'])->name('jenis-pengguna');
    Route::post('/jenis-pengguna', [KonfigurasiController::class, 'jenisPenggunaStore'])->name('jenis-pengguna.store');
    Route::put('/jenis-pengguna/{jenisPengguna}', [KonfigurasiController::class, 'jenisPenggunaUpdate'])->name('jenis-pengguna.update');
    Route::delete('/jenis-pengguna/{jenisPengguna}', [KonfigurasiController::class, 'jenisPenggunaDestroy'])->name('jenis-pengguna.destroy');

    Route::get('/pengguna', [KonfigurasiController::class, 'pengguna'])->name('pengguna');
    Route::post('/pengguna', [KonfigurasiController::class, 'penggunaStore'])->name('pengguna.store');
    Route::put('/pengguna/{user}', [KonfigurasiController::class, 'penggunaUpdate'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [KonfigurasiController::class, 'penggunaDestroy'])->name('pengguna.destroy');

    Route::get('/supplier', [KonfigurasiController::class, 'supplier'])->name('supplier');
    Route::post('/supplier', [KonfigurasiController::class, 'supplierStore'])->name('supplier.store');
    Route::put('/supplier/{supplier}', [KonfigurasiController::class, 'supplierUpdate'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [KonfigurasiController::class, 'supplierDestroy'])->name('supplier.destroy');
});

// Alat & Bahan
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/unit', [BarangController::class, 'berdasarkanUnit'])->name('unit');
    Route::get('/semua', [BarangController::class, 'semua'])->name('semua');
    Route::get('/expire', [BarangController::class, 'expire'])->name('expire');
    Route::post('/', [BarangController::class, 'store'])->name('store');
    Route::put('/{barang}', [BarangController::class, 'update'])->name('update');
    Route::delete('/{barang}', [BarangController::class, 'destroy'])->name('destroy');
});

// Transaksi
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/peminjaman', [TransaksiController::class, 'peminjaman'])->name('peminjaman');
    Route::post('/peminjaman', [TransaksiController::class, 'storePeminjaman'])->name('peminjaman.store');
    Route::get('/data-peminjaman', [TransaksiController::class, 'dataPeminjaman'])->name('data-peminjaman');
    Route::delete('/peminjaman/{peminjaman}', [TransaksiController::class, 'destroyPeminjaman'])->name('peminjaman.destroy');

    Route::get('/supply-baru', [TransaksiController::class, 'supplyBaru'])->name('supply-baru');
    Route::post('/supply-baru', [TransaksiController::class, 'storeSupply'])->name('supply.store');

    Route::get('/permintaan-baru', [TransaksiController::class, 'permintaanBaru'])->name('permintaan-baru');
    Route::post('/permintaan-baru', [TransaksiController::class, 'storePermintaan'])->name('permintaan.store');
    Route::put('/permintaan/{permintaan}/status', [TransaksiController::class, 'updatePermintaanStatus'])->name('permintaan.status');

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
