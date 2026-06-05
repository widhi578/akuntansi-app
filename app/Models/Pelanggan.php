<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'kode_pelanggan',
        'nama_pelanggan',
        'email',
        'telepon',
        'alamat',
        'saldo_piutang'
    ];
}
