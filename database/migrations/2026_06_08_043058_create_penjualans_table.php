<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur', 20)->unique();
            $table->date('tanggal');
            // Menghubungkan faktur dengan ID dari tabel pelanggans
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('restrict');
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
};
