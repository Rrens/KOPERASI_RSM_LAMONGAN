<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthConroller;
use App\Http\Controllers\DashboardConroller;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranKreditController;
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

Route::redirect('/', 'login');

Route::get('login', [AuthConroller::class, 'index'])->name('login');
Route::get('logout', [AuthConroller::class, 'logout'])->name('logout');
Route::post('post_login', [AuthConroller::class, 'post_login'])->name('post_login');
Route::get('print', function () {
    return view('page.print');
});

Route::group(
    [
        'middleware' => ['auth', 'role:0']
    ],
    function () {
        Route::get('dashboard', [DashboardConroller::class, 'index'])->name('dashboard.index');
        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
        Route::post('admin/update', [AdminController::class, 'update'])->name('admin.update');
        Route::post('admin/delete', [AdminController::class, 'delete'])->name('admin.delete');
        Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::post('anggota', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::post('anggota/update', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::post('anggota/delete', [AnggotaController::class, 'delete'])->name('anggota.delete');
        Route::get('pembayaran-kredit', [PembayaranKreditController::class, 'index'])->name('kredit.index');
        Route::post('pembayaran-kredit', [PembayaranKreditController::class, 'store']);
        Route::get('pembayaran-kredit/get-user-id/{id}', [PembayaranKreditController::class, 'get_user_id']);
        Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
        Route::post('pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
        Route::get('pembelian/get-product/{nama}', [PembelianController::class, 'get_product']);
        Route::get('pembelian/get-pembelian-detail/{id}', [PembelianController::class, 'get_pembelian_detail']);
        Route::post('pembelian/update', [PembelianController::class, 'update'])->name('pembelian.update');
        Route::post('pembelian/delete', [PembelianController::class, 'delete'])->name('pembelian.delete');
    }
);

Route::group(
    [
        'middleware' => ['auth', 'role:1']
    ],
    function () {
        Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('penjualan/get-id-anggota/{id}', [PenjualanController::class, 'get_id_anggota']);
        Route::get('penjualan/get-id-product/{id}', [PenjualanController::class, 'get_id_product']);
        Route::get('penjualan/get-id-penjualan/{id}', [PenjualanController::class, 'get_id_penjualan']);
        Route::post('penjualan', [PenjualanController::class, 'post_table_kasir'])->name('post_table_kasir');
        Route::post('penjualan/update', [PenjualanController::class, 'update_table_kasir'])->name('update_table_kasir');
        Route::post('penjualan/delete', [PenjualanController::class, 'delete_table_kasir'])->name('delete_table_kasir');
        Route::get('penjualan/print/{id}', [PenjualanController::class, 'cetak'])->name('penjualan.print');
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/anggota/{id}', [LaporanController::class, 'print_anggota'])->name('laporan.anggota.print');
        Route::get('laporan/pembelian/{id}', [LaporanController::class, 'print_pembelian'])->name('laporan.pembelian.print');
        Route::get('laporan/penjualan/{id}', [LaporanController::class, 'print_penjualan'])->name('laporan.penjualan.print');
    }
);




Route::get('stok-barang', [StokBarangController::class, 'index'])->name('stok.index');
