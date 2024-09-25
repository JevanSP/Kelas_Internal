<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Models\JenisBarang;

Route::get('/', function () {
    return view('layout.layout');
});

// Route::get('/',[HomeController::class, 'home']);

// route::get('/barang', [BarangController::class, 'index'])->name('master/barang/list');

// Route::middleware(['role:admin'])->group(function () {
//     Route::resource('jenis_barang', JenisBarangController::class);
//     Route::resource('barang', BarangController::class);
//     Route::resource('detail_transaksi', DetailTransaksiController::class);
//     Route::resource('transaksi', TransaksiController::class);
// });

route::get('/barang', [BarangController::class, 'index']);
route::get('/barang/create', [BarangController::class, 'create']);
route::post('/barang/store', [BarangController::class, 'store']);
route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
route::post('/barang/{id}/update', [BarangController::class, 'update']);
route::get('/barang/{id}/delete', [BarangController::class, 'delete']);

route::get('/jenisbarang', [JenisBarangController::class, 'index']);
route::get('/jenisbarang/create', [JenisBarangController::class, 'create']);
route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
route::get('/jenisbarang/{id}/edit', [JenisBarangController::class, 'edit']);
route::post('/jenisbarang/{id}/update', [JenisBarangController::class, 'update']);
route::get('/jenisbarang/{id}/delete', [JenisBarangController::class, 'delete']);

route::get('/transaksi', [TransaksiController::class, 'index']);
route::get('/transaksi/create', [TransaksiController::class, 'create']);
route::post('/transaksi/store', [TransaksiController::class, 'store']);
route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
route::post('/transaksi/{id}/update', [TransaksiController::class, 'update']);
route::get('/transaksi/{id}/delete', [TransaksiController::class, 'delete']);

route::get('/detailtransaksi', [DetailTransaksiController::class, 'index']);
route::get('/detailtransaksi/create', [DetailTransaksiController::class, 'create']);
route::post('/detailtransaksi/store', [DetailTransaksiController::class, 'store']);
route::get('/detailtransaksi/{id}/edit', [DetailTransaksiController::class, 'edit']);
route::post('/detailtransaksi/{id}/update', [DetailTransaksiController::class, 'update']);
route::get('/detailtransaksi/{id}/delete', [DetailTransaksiController::class, 'delete']);

