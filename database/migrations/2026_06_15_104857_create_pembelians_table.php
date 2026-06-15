<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur', 20)->unique(); // Nomor faktur dari supplier
            $table->date('tanggal');
            // Menghubungkan faktur dengan ID dari tabel pemasoks
            $table->foreignId('pemasok_id')->constrained('pemasoks')->onDelete('restrict');
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
};
