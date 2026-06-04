@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                Tambah Master Barang
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" placeholder="Contoh: BRG-001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipe Barang</label>
                            <select class="form-select" name="tipe_barang">
                                <option value="Persediaan">Persediaan (Inventory)</option>
                                <option value="Non-Persediaan">Non-Persediaan</option>
                                <option value="Jasa">Jasa (Service)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Contoh: Baut Baja 10mm" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" placeholder="Contoh: Material">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" value="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok Awal</label>
                        <input type="number" class="form-control" name="stok_awal" value="0" style="width: 150px;">
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection