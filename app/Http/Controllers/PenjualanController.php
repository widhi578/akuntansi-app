<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Barang;
use App\Models\DetailPenjualan; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Menampilkan daftar faktur penjualan
    public function index()
    {
        // Mengambil data penjualan beserta relasi nama pelanggannya
        $all_penjualan = Penjualan::with('pelanggan')->orderBy('tanggal', 'desc')->get();
        
        return view('penjualan.index', compact('all_penjualan'));
    }

    // Menampilkan form pembuatan faktur penjualan
    public function create()
    {
        // Panggil data pelanggan dan barang untuk ditampilkan di form dropdown
        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();

        // Membuat nomor faktur otomatis (Contoh: INV-20260608-001)
        $hari_ini = date('Ymd');
        $faktur_terakhir = Penjualan::whereDate('tanggal', date('Y-m-d'))->count();
        $nomor_urut = str_pad($faktur_terakhir + 1, 3, '0', STR_PAD_LEFT);
        $no_faktur_otomatis = 'INV-' . $hari_ini . '-' . $nomor_urut;

        return view('penjualan.create', compact('pelanggans', 'barangs', 'no_faktur_otomatis'));
    }

    // Menyimpan data faktur, detail, dan memotong stok
    public function store(Request $request)
    {
        // 1. Validasi Data Dasar
        $request->validate([
            'no_faktur'    => 'required|unique:penjualans,no_faktur',
            'tanggal'      => 'required|date',
            'pelanggan_id' => 'required',
            'barang_id'    => 'required|array', // Harus berupa array karena barangnya bisa banyak
            'jumlah'       => 'required|array',
        ]);

        // 2. Gunakan DB Transaction
        // Ini fitur keamanan agar jika proses simpan detail gagal di tengah jalan, 
        // data induknya tidak akan tersimpan (mencegah data setengah matang/korup).
        DB::transaction(function () use ($request) {
            
            // A. Simpan data ke tabel induk (penjualans)
            $penjualan = Penjualan::create([
                'no_faktur'    => $request->no_faktur,
                'tanggal'      => $request->tanggal,
                'pelanggan_id' => $request->pelanggan_id,
                'total_harga'  => $request->total_harga,
                'keterangan'   => $request->keterangan,
            ]);

            // B. Looping (Ulangi) untuk menyimpan setiap barang di tabel detail
            foreach ($request->barang_id as $key => $barang_id) {
                
                // Pastikan ada barang yang dipilih (bukan baris kosong)
                if ($barang_id != null) {
                    
                    // Simpan ke tabel detail_penjualans
                    DetailPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'barang_id'    => $barang_id,
                        'harga_satuan' => $request->harga_satuan[$key],
                        'jumlah'       => $request->jumlah[$key],
                        'subtotal'     => $request->subtotal[$key],
                    ]);

                    // C. Potong stok di Master Barang
                    $barang = Barang::find($barang_id);
                    $barang->stok_awal = $barang->stok_awal - $request->jumlah[$key];
                    $barang->save();
                }
            }
        });

        // 3. Jika semua berhasil, kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('penjualan.index')->with('sukses', 'Faktur Penjualan berhasil disimpan dan stok barang telah dipotong otomatis!');
    }

    // Menampilkan detail spesifik dari satu faktur penjualan
    public function show(Penjualan $penjualan)
    {
        // Memuat (eager load) relasi agar kita bisa memanggil nama pelanggan dan nama barang
        $penjualan->load('pelanggan', 'detail.barang');
        
        return view('penjualan.show', compact('penjualan'));
    }
}