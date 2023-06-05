<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardConroller;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'dashboard');

Route::get('dashboard', [DashboardConroller::class, 'index'])->name('dashboard.index');
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('stok-barang', [StokBarangController::class, 'index'])->name('stok.index');
Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
