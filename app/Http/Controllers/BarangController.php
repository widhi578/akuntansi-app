<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menangkap teks yang diketik pengguna di kolom pencarian
        $katakunci = $request->search;

        // Jika pengguna mengetikkan sesuatu
        if (strlen($katakunci)) {
            // Cari barang yang nama ATAU kodenya mirip dengan kata kunci
            $all_barang = Barang::where('nama_barang', 'like', "%$katakunci%")
                                ->orWhere('kode_barang', 'like', "%$katakunci%")
                                ->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua barang
            $all_barang = Barang::all();
        }

        return view('barang.index', compact('all_barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Memanggil file view resources/views/barang/create.blade.php
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi agar data yang diinput aman dan sesuai aturan
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang|max:20',
            'nama_barang' => 'required|max:100',
            'tipe_barang' => 'required',
            'harga_beli'  => 'numeric',
            'harga_jual'  => 'numeric',
            'stok_awal'   => 'integer',
        ]);

        // Simpan data ke database
        Barang::create($request->all());

        // Setelah sukses disimpan, kembali ke halaman daftar barang dengan pesan sukses
        return redirect()->route('barang.index')->with('sukses', 'Barang baru berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        // Laravel otomatis mencari data barang berdasarkan ID berkat Route Model Binding
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        // Validasi data. Khusus kode_barang, abaikan keunikan untuk ID barang ini sendiri
        $request->validate([
            'kode_barang' => 'required|max:20|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|max:100',
            'tipe_barang' => 'required',
            'harga_beli'  => 'numeric',
            'harga_jual'  => 'numeric',
        ]);

        // Update data di database
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('sukses', 'Data barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete(); // Menghapus dari database

        return redirect()->route('barang.index')->with('sukses', 'Barang berhasil dihapus!');
    }
}
