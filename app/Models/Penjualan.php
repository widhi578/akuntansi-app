<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['no_faktur', 'tanggal', 'pelanggan_id', 'total_harga', 'keterangan'];

    // Relasi: Satu penjualan milik satu pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi: Satu penjualan memiliki banyak detail barang
    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
