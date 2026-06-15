<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pemasok;
use App\Models\Barang;
use App\Models\DetailPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    // Menampilkan daftar faktur pembelian
    public function index()
    {
        $all_pembelian = Pembelian::with('pemasok')->orderBy('tanggal', 'desc')->get();
        return view('pembelian.index', compact('all_pembelian'));
    }

    // Menampilkan form pembuatan faktur pembelian
    public function create()
    {
        $pemasoks = Pemasok::all();
        $barangs = Barang::all();

        // Membuat nomor faktur otomatis (PO = Purchase Order)
        $hari_ini = date('Ymd');
        $faktur_terakhir = Pembelian::whereDate('tanggal', date('Y-m-d'))->count();
        $nomor_urut = str_pad($faktur_terakhir + 1, 3, '0', STR_PAD_LEFT);
        $no_faktur_otomatis = 'PO-' . $hari_ini . '-' . $nomor_urut;

        return view('pembelian.create', compact('pemasoks', 'barangs', 'no_faktur_otomatis'));
    }

    // Menyimpan data pembelian dan MENAMBAH stok
    public function store(Request $request)
    {
        $request->validate([
            'no_faktur'    => 'required|unique:pembelians,no_faktur',
            'tanggal'      => 'required|date',
            'pemasok_id'   => 'required',
            'barang_id'    => 'required|array',
            'jumlah'       => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            
            // A. Simpan data ke tabel induk
            $pembelian = Pembelian::create([
                'no_faktur'    => $request->no_faktur,
                'tanggal'      => $request->tanggal,
                'pemasok_id'   => $request->pemasok_id,
                'total_harga'  => $request->total_harga,
                'keterangan'   => $request->keterangan,
            ]);

            // B. Looping untuk menyimpan detail
            foreach ($request->barang_id as $key => $barang_id) {
                if ($barang_id != null) {
                    
                    DetailPembelian::create([
                        'pembelian_id' => $pembelian->id,
                        'barang_id'    => $barang_id,
                        'harga_satuan' => $request->harga_satuan[$key],
                        'jumlah'       => $request->jumlah[$key],
                        'subtotal'     => $request->subtotal[$key],
                    ]);

                    // C. TAMBAH stok di Master Barang (Ini kuncinya!)
                    $barang = Barang::find($barang_id);
                    $barang->stok_awal = $barang->stok_awal + $request->jumlah[$key];
                    $barang->save();
                }
            }
        });

        return redirect()->route('pembelian.index')->with('sukses', 'Faktur Pembelian berhasil disimpan dan stok barang telah BERTAMBAH otomatis!');
    }

    // Menampilkan detail faktur (Struk)
    public function show(Pembelian $pembelian)
    {
        $pembelian->load('pemasok', 'detail.barang');
        return view('pembelian.show', compact('pembelian'));
    }
}