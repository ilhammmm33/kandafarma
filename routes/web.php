<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;

/**
 * ========================
 * 1️⃣ Public Pages (No Auth)
 * ========================
 */
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/stok-obat', [PublicController::class, 'stok'])->name('public.stok');
Route::get('/rekomendasi-obat', [PublicController::class, 'rekomendasi'])->name('public.rekomendasi');
Route::post('/rekomendasi-obat', [PublicController::class, 'prosesRekomendasi'])->name('public.rekomendasi.proses');

/**
 * ========================
 * 2️⃣ General Dashboard (Role Based Redirect di controller)
 * ========================
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * ========================
 * 3️⃣ Profile User (Auth only)
 * ========================
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * ========================
 * 4️⃣ Admin Routes (CRUD, Kasir, Laporan, Dashboard)
 * ========================
 */
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Obat
    Route::resource('obat', ObatController::class);

    // Kasir (Admin bisa akses riwayat, nota, dll)
    Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('kasir', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('kasir/riwayat', [KasirController::class, 'riwayat'])->name('kasir.riwayat');
    Route::delete('kasir/{id}', [KasirController::class, 'destroy'])->name('kasir.destroy');
    Route::get('kasir/nota/{id}', [KasirController::class, 'nota'])->name('kasir.nota');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/statistik', [LaporanController::class, 'statistik'])->name('laporan.statistik');
    Route::get('laporan/obat-menurun', [LaporanController::class, 'obatMenurun'])->name('laporan.obat_menurun');
});

/**
 * ========================
 * 5️⃣ Kasir Routes (Kasir hanya bisa transaksi)
 * ========================
 */
Route::prefix('kasir')->middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/transaksi', [KasirController::class, 'index'])->name('kasir.transaksi');
});

require __DIR__.'/auth.php';
