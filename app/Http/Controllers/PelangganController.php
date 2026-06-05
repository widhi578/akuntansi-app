<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Pastikan model Pelanggan dipanggil
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Menampilkan daftar pelanggan dengan fitur pencarian
    public function index(Request $request)
    {
        $katakunci = $request->search;

        if (strlen($katakunci)) {
            $all_pelanggan = Pelanggan::where('nama_pelanggan', 'like', "%$katakunci%")
                                ->orWhere('kode_pelanggan', 'like', "%$katakunci%")
                                ->get();
        } else {
            $all_pelanggan = Pelanggan::all();
        }

        return view('pelanggan.index', compact('all_pelanggan'));
    }

    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // Menyimpan data pelanggan baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan|max:20',
            'nama_pelanggan' => 'required|max:100',
            'email'          => 'nullable|email|max:100', // nullable = boleh kosong, tapi jika diisi harus format email
            'telepon'        => 'nullable|max:20',
            'saldo_piutang'  => 'numeric',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('sukses', 'Pelanggan baru berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit pelanggan
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Memproses perubahan data dari form edit ke database
    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Validasi data, pastikan kode_pelanggan unik kecuali untuk ID pelanggan ini sendiri
        $request->validate([
            'kode_pelanggan' => 'required|max:20|unique:pelanggans,kode_pelanggan,' . $pelanggan->id,
            'nama_pelanggan' => 'required|max:100',
            'email'          => 'nullable|email|max:100',
            'telepon'        => 'nullable|max:20',
            'saldo_piutang'  => 'numeric',
        ]);

        // Simpan perubahan ke database
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('sukses', 'Data pelanggan berhasil diperbarui!');
    }

    // Menghapus data pelanggan
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete(); // Hapus dari database

        return redirect()->route('pelanggan.index')->with('sukses', 'Data pelanggan berhasil dihapus!');
    }
}