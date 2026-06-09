@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Detail Faktur Penjualan</h5>
                <span class="badge bg-primary fs-6">{{ $penjualan->no_faktur }}</span>
            </div>
            <div class="card-body p-5">
                
                <div class="row border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <h4 class="fw-bold text-primary mb-1">ACCURATE WEB</h4>
                        <p class="text-muted mb-0">Sistem Informasi Akuntansi & ERP</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted">Tanggal:</td>
                                <td class="fw-bold">{{ date('d F Y', strtotime($penjualan->tanggal)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kepada Yth:</td>
                                <td class="fw-bold">{{ $penjualan->pelanggan->nama_pelanggan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan->detail as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->barang->kode_barang }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end fw-bold">TOTAL KESELURUHAN</td>
                            <td class="text-end text-success fw-bold fs-5">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                @if($penjualan->keterangan)
                <div class="mt-4">
                    <p class="mb-1 text-muted"><strong>Catatan / Keterangan:</strong></p>
                    <p class="border p-2 bg-light">{{ $penjualan->keterangan }}</p>
                </div>
                @endif

            </div>
            
            <div class="card-footer bg-white text-end py-3">
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button class="btn btn-primary" onclick="window.print()">Cetak Faktur</button>
            </div>
        </div>
    </div>
</div>
@endsection