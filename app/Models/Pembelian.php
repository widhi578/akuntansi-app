<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = ['no_faktur', 'tanggal', 'pemasok_id', 'total_harga', 'keterangan'];

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
