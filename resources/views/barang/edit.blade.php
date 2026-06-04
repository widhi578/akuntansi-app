@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark fw-bold">
                Edit Master Barang: {{ $barang->nama_barang }}
            </div>
            <div class="card-body">
                
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" value="{{ $barang->kode_barang }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipe Barang</label>
                            <select class="form-select" name="tipe_barang">
                                <option value="Persediaan" {{ $barang->tipe_barang == 'Persediaan' ? 'selected' : '' }}>Persediaan (Inventory)</option>
                                <option value="Non-Persediaan" {{ $barang->tipe_barang == 'Non-Persediaan' ? 'selected' : '' }}>Non-Persediaan</option>
                                <option value="Jasa" {{ $barang->tipe_barang == 'Jasa' ? 'selected' : '' }}>Jasa (Service)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" value="{{ $barang->kategori }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" value="{{ $barang->harga_beli }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" value="{{ $barang->harga_jual }}">
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection