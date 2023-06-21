<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthConroller;
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

Route::get('login', [AuthConroller::class, 'index'])->name('login');
Route::get('dashboard', [DashboardConroller::class, 'index'])->name('dashboard.index');
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
Route::post('admin/update', [AdminController::class, 'update'])->name('admin.update');
Route::post('admin/delete', [AdminController::class, 'delete'])->name('admin.delete');
Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::post('anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::post('anggota/update', [AnggotaController::class, 'update'])->name('anggota.update');
Route::post('anggota/delete', [AnggotaController::class, 'delete'])->name('anggota.delete');
Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('penjualan/get-id-anggota/{id}', [PenjualanController::class, 'get_id_anggota']);
Route::get('penjualan/get-id-product/{id}', [PenjualanController::class, 'get_id_product']);
Route::post('penjualan', [PenjualanController::class, 'post_table_kasir'])->name('post_table_kasir');
Route::post('penjualan/update', [PenjualanController::class, 'update_table_kasir'])->name('update_table_kasir');
Route::post('penjualan/delete', [PenjualanController::class, 'delete_table_kasir'])->name('delete_table_kasir');
Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('stok-barang', [StokBarangController::class, 'index'])->name('stok.index');
Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
