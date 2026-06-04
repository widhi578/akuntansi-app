<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

// Rute resource akan otomatis membuatkan URL seperti /barang, /barang/create, dll.
Route::resource('barang', BarangController::class);
