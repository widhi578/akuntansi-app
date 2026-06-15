<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->constrained('pembelians')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('restrict');
            $table->integer('jumlah'); // Qty barang yang masuk
            $table->decimal('harga_satuan', 15, 2); // Harga beli dari supplier
            $table->decimal('subtotal', 15, 2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
