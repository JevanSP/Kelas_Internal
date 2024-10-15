<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\LoginController;

route::get('/', [LoginController::class, 'index'])->name('login');

route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

route::get('/logout', [LoginController::class, 'logout'])->name('logout');

route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

route::get('/user', [UserController::class, 'index']);
route::get('/user/create', [UserController::class, 'create']);
route::post('/user/store', [UserController::class, 'store']);
route::post('/user/update/{id}', [UserController::class, 'update']);
route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

route::get('/barang', [BarangController::class, 'index']);
route::get('/barang/create', [BarangController::class, 'create']);
route::post('/barang/store', [BarangController::class, 'store']);
route::post('/barang/update/{id}', [BarangController::class, 'update']);
route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);

route::get('/jenisbarang', [JenisBarangController::class, 'index']);
route::get('/jenisbarang/create', [JenisBarangController::class, 'create']);
route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);

route::get('/transaksi', [TransaksiController::class, 'index']);
route::get('/transaksi/add', [TransaksiController::class, 'add'])->name('transaksi.add');
route::post('/transaksi/store', [TransaksiController::class, 'store']);
route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail']);
route::get('/transaksi/view_pdf/{id}', [TransaksiController::class, 'view_pdf']);
route::get('/transaksi/download_pdf/{id}', [TransaksiController::class, 'download_pdf']);
