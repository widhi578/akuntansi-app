<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelanggan', 20)->unique();
            $table->string('nama_pelanggan', 100);
            $table->string('email', 100)->nullable(); // nullable = boleh dikosongkan
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->decimal('saldo_piutang', 15, 2)->default(0); // Saldo awal hutang pelanggan ke kita
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
