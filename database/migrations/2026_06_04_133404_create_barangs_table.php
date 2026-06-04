<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // ID otomatis (Primary Key)
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->string('kategori', 50)->nullable();
            $table->enum('tipe_barang', ['Persediaan', 'Non-Persediaan', 'Jasa'])->default('Persediaan');
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->integer('stok_awal')->default(0);
            $table->timestamps(); // Otomatis mencatat waktu dibuat/diubah (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
