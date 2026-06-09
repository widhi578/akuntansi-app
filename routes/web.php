<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;

// Rute resource akan otomatis membuatkan URL seperti /barang, /barang/create, dll.
Route::resource('barang', BarangController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('pemasok', PemasokController::class);
Route::resource('penjualan', PenjualanController::class);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
