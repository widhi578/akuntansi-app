@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Daftar Faktur pembelian</h5>
        <a href="{{ route('pembelian.create') }}" class="btn btn-primary btn-sm">Buat Faktur Baru</a>
    </div>
    <div class="card-body">

        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>Nama pemasok</th>
                        <th class="text-end">Total Belanja</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_pembelian as $item)
                        <tr>
                            <td class="fw-bold text-primary">{{ $item->no_faktur }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                            <td>{{ $item->pemasok->nama_pemasok }}</td>
                            <td class="text-end text-success fw-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('pembelian.show', $item->id) }}" class="btn btn-info btn-sm text-white fw-bold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada transaksi pembelian. Silakan buat faktur baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection