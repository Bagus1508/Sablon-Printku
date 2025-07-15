<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('serah_terima_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjualan_barang');
            $table->string('no_transaksi');
            $table->string('nama_penerima');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah_terima_barang');
    }
};
