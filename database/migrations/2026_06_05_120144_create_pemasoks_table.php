<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemasoks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemasok', 20)->unique();
            $table->string('nama_pemasok', 100);
            $table->string('email', 100)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            // Pemasok menggunakan saldo_hutang (hutang kita ke mereka)
            $table->decimal('saldo_hutang', 15, 2)->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemasoks');
    }
};
