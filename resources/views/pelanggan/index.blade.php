@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Daftar Master Pelanggan</h5>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">Tambah Pelanggan</a>
    </div>
    <div class="card-body">

        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-3 mt-3">
            <div class="col-md-5">
                <form action="{{ route('pelanggan.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari nama atau kode pelanggan..." value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                        
                        @if(request('search'))
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-danger">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th class="text-end">Saldo Piutang</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_pelanggan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold text-secondary">{{ $item->kode_pelanggan }}</td>
                            <td class="fw-bold">{{ $item->nama_pelanggan }}</td>
                            <td>
                                <small>
                                    Email: {{ $item->email ?? '-' }} <br>
                                    Telp: {{ $item->telepon ?? '-' }}
                                </small>
                            </td>
                            <td>{{ Str::limit($item->alamat, 30) ?? '-' }}</td>
                            <td class="text-end text-danger fw-bold">Rp {{ number_format($item->saldo_piutang, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data pelanggan. Silakan tambah pelanggan baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection