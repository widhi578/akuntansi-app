<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan detail dengan ID Faktur dan ID Barang
            $table->foreignId('penjualan_id')->constrained('penjualans')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('restrict');
            
            $table->integer('jumlah'); // Qty barang yang dibeli
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2); // jumlah * harga_satuan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
