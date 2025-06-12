<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin'))->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/users/{id}/update-role', [AdminController::class, 'updateRole'])->name('admin.users.update-role');

    Route::get('/produk-verifikasi', [AdminController::class, 'verifikasiProduk'])->name('admin.produk.verifikasi');
    Route::post('/produk-verifikasi/{id}/setujui', [AdminController::class, 'approveProduk'])->name('admin.produk.setujui');

    Route::get('/monitoring', [AdminController::class, 'monitoring'])->name('admin.monitoring');
    Route::get('/produk-terverifikasi', [AdminController::class, 'produkTerverifikasi'])->name('admin.produk.terverifikasi');

    Route::get('/produk-terverifikasi/cetak', [AdminController::class, 'cetakProdukTerverifikasi'])->name('admin.produk.terverifikasi.cetak');
    Route::get('/monitoring/cetak', [AdminController::class, 'cetakMonitoring'])->name('admin.monitoring.cetak');


});

// Dashboard Pelanggan
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('pelanggan.produk'))->name('pelanggan.dashboard');

    // 🛒 Marketplace Produk
    Route::get('/produk', [PelangganController::class, 'listProduk'])->name('pelanggan.produk');
    Route::get('/produk/{id}', [PelangganController::class, 'detailProduk'])->name('pelanggan.produk.detail');
    Route::post('/produk/{id}/beli', [PelangganController::class, 'beli'])->name('pelanggan.produk.beli');

    // 🌟 Ulasan Produk
    Route::get('/produk/{id}/ulasan/{trx}', [PelangganController::class, 'formUlasan'])->name('pelanggan.ulasan.form');
    Route::post('/produk/{id}/ulasan/{trx}', [PelangganController::class, 'beriUlasan'])->name('pelanggan.produk.ulasan');

    // 💻 Jual Perangkat
    Route::get('/jual', [PelangganController::class, 'jualForm'])->name('pelanggan.jual');
    Route::post('/jual', [PelangganController::class, 'jualSubmit'])->name('pelanggan.jual.submit');

    // 🧠 Rekomendasi Upgrade
    Route::get('/upgrade', [PelangganController::class, 'upgradeForm'])->name('pelanggan.upgrade');
    Route::post('/upgrade', [PelangganController::class, 'upgradeResult'])->name('pelanggan.upgrade.result');

    // 📜 Riwayat Transaksi
    Route::get('/riwayat', [PelangganController::class, 'riwayat'])->name('pelanggan.riwayat');

    // 🛠️ Panggil Teknisi
    Route::get('/servis', [PelangganController::class, 'servisForm'])->name('pelanggan.servis');
    Route::post('/servis', [PelangganController::class, 'servisSubmit'])->name('pelanggan.servis.submit');
});

// Dashboard Teknisi
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('teknisi.servis.index'))->name('teknisi.dashboard');

    Route::get('/servis', [TeknisiController::class, 'index'])->name('teknisi.servis.index');
    Route::get('/servis/{id}', [TeknisiController::class, 'show'])->name('teknisi.servis.show');
    Route::put('/servis/{id}/update', [TeknisiController::class, 'update'])->name('teknisi.servis.update');
});

// Dashboard Toko
Route::middleware(['auth', 'role:toko'])->prefix('toko')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('toko.produk.index'))->name('toko.dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])->name('toko.produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('toko.produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('toko.produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('toko.produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('toko.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('toko.produk.destroy');

    Route::get('/laporan', [TokoController::class, 'laporan'])->name('toko.laporan');
    Route::put('/toko/transaksi/{id}/update', [TokoController::class, 'updateTransaksi'])->name('toko.laporan.update');

    Route::get('/ulasan', [TokoController::class, 'ulasan'])->name('toko.ulasan');
});

