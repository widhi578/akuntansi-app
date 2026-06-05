@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark fw-bold">
                Edit Data Pelanggan: {{ $pelanggan->nama_pelanggan }}
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Pelanggan</label>
                            <input type="text" class="form-control" name="kode_pelanggan" value="{{ $pelanggan->kode_pelanggan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $pelanggan->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon / WA</label>
                            <input type="text" class="form-control" name="telepon" value="{{ $pelanggan->telepon }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" rows="3">{{ $pelanggan->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Saldo Awal Piutang (Rp)</label>
                        <input type="number" class="form-control" name="saldo_piutang" value="{{ $pelanggan->saldo_piutang }}" style="width: 200px;">
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Pelanggan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection