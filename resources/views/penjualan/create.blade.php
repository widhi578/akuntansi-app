@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        Buat Faktur Penjualan Baru
    </div>
    <div class="card-body">
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">No. Faktur</label>
                    <input type="text" class="form-control bg-light" name="no_faktur" value="{{ $no_faktur_otomatis }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Pelanggan</label>
                    <select class="form-select" name="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>
            
            <h6 class="fw-bold mb-3">Detail Barang yang Dibeli</h6>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="tabel-barang">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Barang</th>
                            <th width="180">Harga Satuan (Rp)</th>
                            <th width="100">Qty</th>
                            <th width="200">Subtotal (Rp)</th>
                            <th width="50" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-barang">
                        <tr>
                            <td>
                                <select class="form-select barang-select" name="barang_id[]" required onchange="updateHarga(this)">
                                    <option value="" data-harga="0">-- Pilih Barang --</option>
                                    @foreach($barangs as $b)
                                        <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}">{{ $b->kode_barang }} - {{ $b->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control harga-input" name="harga_satuan[]" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control qty-input" name="jumlah[]" min="1" value="1" required oninput="hitungSubtotal(this)">
                            </td>
                            <td>
                                <input type="number" class="form-control subtotal-input bg-light" name="subtotal[]" readonly>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="tambahBaris()">+ Tambah Baris Barang</button>
                    <br>
                    <label class="form-label">Keterangan / Catatan</label>
                    <textarea class="form-control" name="keterangan" rows="2" placeholder="Opsional..."></textarea>
                </div>
                <div class="col-md-6 text-end">
                    <h3 class="fw-bold mt-4">Total: Rp <span id="label-total">0</span></h3>
                    <input type="hidden" name="total_harga" id="input-total" value="0">
                </div>
            </div>

            <hr>
            <div class="text-end">
                <a href="{{ route('penjualan.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary fw-bold">Simpan Faktur</button>
            </div>
        </form>
    </div>
</div>

<script>
    // 1. Fungsi saat barang dipilih -> otomatis memunculkan harga
    function updateHarga(element) {
        let row = element.closest('tr'); // Cari baris tempat dropdown ini berada
        let harga = element.options[element.selectedIndex].getAttribute('data-harga'); // Ambil atribut data-harga
        row.querySelector('.harga-input').value = harga; // Isi kolom harga
        hitungSubtotal(element); // Hitung ulang subtotalnya
    }

    // 2. Fungsi mengalikan Harga x Qty
    function hitungSubtotal(element) {
        let row = element.closest('tr');
        let harga = row.querySelector('.harga-input').value || 0;
        let qty = row.querySelector('.qty-input').value || 0;
        let subtotal = parseFloat(harga) * parseFloat(qty);
        
        row.querySelector('.subtotal-input').value = subtotal; // Isi kolom subtotal
        hitungGrandTotal(); // Panggil fungsi hitung total keseluruhan
    }

    // 3. Fungsi menjumlahkan semua subtotal di tabel
    function hitungGrandTotal() {
        let subtotals = document.querySelectorAll('.subtotal-input');
        let total = 0;
        
        subtotals.forEach(function(item) {
            total += parseFloat(item.value || 0);
        });
        
        // Update angka di layar dan di input hidden
        document.getElementById('input-total').value = total;
        document.getElementById('label-total').innerText = total.toLocaleString('id-ID'); // Format angka ribuan
    }

    // 4. Fungsi menambah baris tabel baru
    function tambahBaris() {
        let tbody = document.getElementById('tbody-barang');
        let rowPertama = tbody.querySelector('tr').cloneNode(true); // Gandakan baris pertama
        
        // Bersihkan isian di baris baru tersebut
        rowPertama.querySelector('.barang-select').value = "";
        rowPertama.querySelector('.harga-input').value = "";
        rowPertama.querySelector('.qty-input').value = "1";
        rowPertama.querySelector('.subtotal-input').value = "";
        
        tbody.appendChild(rowPertama); // Masukkan ke tabel
    }

    // 5. Fungsi menghapus baris
    function hapusBaris(button) {
        let tbody = document.getElementById('tbody-barang');
        if (tbody.children.length > 1) { // Pastikan sisa minimal 1 baris
            button.closest('tr').remove();
            hitungGrandTotal(); // Hitung ulang totalnya
        } else {
            alert('Faktur minimal harus memiliki 1 barang!');
        }
    }
</script>
@endsection