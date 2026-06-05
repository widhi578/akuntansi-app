@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Daftar Master Barang & Jasa</h5>
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">Tambah Barang</a>
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
                <form action="{{ route('barang.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari nama atau kode barang..." value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                        
                        @if(request('search'))
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-danger">Reset</a>
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
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tipe</th>
                        <th>Kategori</th>
                        <th class="text-end">Harga Beli</th>
                        <th class="text-end">Harga Jual</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_barang as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold text-secondary">{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item->tipe_barang }}</span></td>
                            <td>{{ $item->kategori ?? '-' }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center fw-bold">{{ $item->stok_awal }}</td>
                            <td class="text-center">
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>       
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data barang. Silakan tambah barang baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection