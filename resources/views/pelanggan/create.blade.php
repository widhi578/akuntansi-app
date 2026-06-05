@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white fw-bold">
                Tambah Data Pelanggan Baru
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Pelanggan</label>
                            <input type="text" class="form-control" name="kode_pelanggan" placeholder="Contoh: CUST-001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" placeholder="Contoh: Batik Sari Nusantara" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email@contoh.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon / WA</label>
                            <input type="text" class="form-control" name="telepon" placeholder="Contoh: 08123456789">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap pelanggan..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Saldo Awal Piutang (Rp)</label>
                        <input type="number" class="form-control" name="saldo_piutang" value="0" style="width: 200px;">
                        <small class="text-muted">Isi jika pelanggan memiliki tunggakan/hutang lama ke kita.</small>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan Pelanggan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection