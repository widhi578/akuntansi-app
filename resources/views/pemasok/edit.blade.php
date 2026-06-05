@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark fw-bold">
                Edit Data Pemasok: {{ $pemasok->nama_pemasok }}
            </div>
            <div class="card-body">
                <form action="{{ route('pemasok.update', $pemasok->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Pemasok</label>
                            <input type="text" class="form-control" name="kode_pemasok" value="{{ $pemasok->kode_pemasok }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama pemasok</label>
                            <input type="text" class="form-control" name="nama_pemasok" value="{{ $pemasok->nama_pemasok }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $pemasok->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon / WA</label>
                            <input type="text" class="form-control" name="telepon" value="{{ $pemasok->telepon }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" rows="3">{{ $pemasok->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Saldo Awal Piutang (Rp)</label>
                        <input type="number" class="form-control" name="saldo_hutang" value="{{ $pemasok->saldo_hutang }}" style="width: 200px;">
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pemasok.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui pemasok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection