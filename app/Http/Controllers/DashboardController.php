<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib dipanggil untuk query grafik

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung data untuk Kotak Ringkasan (Card)
        $total_barang = Barang::count();
        $total_pelanggan = Pelanggan::count();
        $total_faktur = Penjualan::count();
        $total_pendapatan = Penjualan::sum('total_harga'); // Menjumlahkan seluruh isi kolom total_harga

        // 2. Mengambil data untuk Grafik (Total Pendapatan per Tanggal)
        // Kita kelompokkan berdasarkan tanggal, lalu ambil 7 hari terakhir
        $grafik_penjualan = Penjualan::select(
            DB::raw('DATE(tanggal) as tgl'),
            DB::raw('SUM(total_harga) as total')
        )
        ->groupBy('tgl')
        ->orderBy('tgl', 'asc')
        ->limit(7)
        ->get();

        // 3. Memisahkan data agar bisa dibaca oleh Chart.js
        $labels = [];      // Untuk tanggal di sumbu X
        $data_total = [];  // Untuk total uang di sumbu Y

        foreach ($grafik_penjualan as $grafik) {
            $labels[] = date('d M Y', strtotime($grafik->tgl)); // Contoh format: 09 Jun 2026
            $data_total[] = $grafik->total;
        }

        // Kirim semua variabel ke tampilan dashboard
        return view('dashboard', compact('total_barang', 'total_pelanggan', 'total_faktur', 'total_pendapatan', 'labels', 'data_total'));
    }
}