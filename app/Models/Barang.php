<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi oleh form
    protected $fillable = [
        'kode_barang', 
        'nama_barang', 
        'kategori', 
        'tipe_barang', 
        'harga_beli', 
        'harga_jual', 
        'stok_awal'
    ];
}
