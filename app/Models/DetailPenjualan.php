<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_id', 'barang_id', 'jumlah', 'harga_satuan', 'subtotal'];

    // Relasi: Detail ini milik faktur penjualan tertentu
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    // Relasi: Detail ini merujuk pada master barang tertentu
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
