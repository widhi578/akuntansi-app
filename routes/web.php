<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;

// Rute resource akan otomatis membuatkan URL seperti /barang, /barang/create, dll.
Route::resource('barang', BarangController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('pemasok', PemasokController::class);
