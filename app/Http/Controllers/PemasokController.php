<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->search;
        if (strlen($katakunci)) {
            $all_pemasok = Pemasok::where('nama_pemasok', 'like', "%$katakunci%")
                                ->orWhere('kode_pemasok', 'like', "%$katakunci%")
                                ->get();
        } else {
            $all_pemasok = Pemasok::all();
        }
        return view('pemasok.index', compact('all_pemasok'));
    }

    public function create()
    {
        return view('pemasok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pemasok' => 'required|unique:pemasoks,kode_pemasok|max:20',
            'nama_pemasok' => 'required|max:100',
            'email'        => 'nullable|email|max:100',
            'telepon'      => 'nullable|max:20',
            'saldo_hutang' => 'numeric',
        ]);

        Pemasok::create($request->all());
        return redirect()->route('pemasok.index')->with('sukses', 'Pemasok berhasil ditambahkan!');
    }

    public function edit(Pemasok $pemasok)
    {
        return view('pemasok.edit', compact('pemasok'));
    }

    public function update(Request $request, Pemasok $pemasok)
    {
        $request->validate([
            'kode_pemasok' => 'required|max:20|unique:pemasoks,kode_pemasok,' . $pemasok->id,
            'nama_pemasok' => 'required|max:100',
            'email'        => 'nullable|email|max:100',
            'telepon'      => 'nullable|max:20',
            'saldo_hutang' => 'numeric',
        ]);

        $pemasok->update($request->all());
        return redirect()->route('pemasok.index')->with('sukses', 'Data pemasok berhasil diperbarui!');
    }

    public function destroy(Pemasok $pemasok)
    {
        $pemasok->delete();
        return redirect()->route('pemasok.index')->with('sukses', 'Data pemasok berhasil dihapus!');
    }
}