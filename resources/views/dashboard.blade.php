@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-secondary">Dashboard Ringkasan</h3>
    <p class="text-muted">Selamat datang di Sistem Informasi Akuntansi & ERP</p>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title">Total Pendapatan</h6>
                <h3 class="fw-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title">Total Faktur Keluar</h6>
                <h3 class="fw-bold">{{ $total_faktur }} Transaksi</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title">Master Barang</h6>
                <h3 class="fw-bold">{{ $total_barang }} Item</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title">Total Pelanggan</h6>
                <h3 class="fw-bold">{{ $total_pelanggan }} Orang</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">
                Grafik Penjualan (7 Hari Terakhir)
            </div>
            <div class="card-body">
                <canvas id="grafikPenjualan" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data dari PHP (Controller) dan ubah ke format JSON agar bisa dibaca JavaScript
    const labels = {!! json_encode($labels) !!};
    const dataTotal = {!! json_encode($data_total) !!};

    const ctx = document.getElementById('grafikPenjualan').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar', // Bisa diubah ke 'line' (garis) atau 'pie' (kue)
        data: {
            labels: labels, // Sumbu X (Tanggal)
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: dataTotal, // Sumbu Y (Total Uang)
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna batang grafik
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Sumbu Y dimulai dari angka 0
                }
            }
        }
    });
</script>
@endsection