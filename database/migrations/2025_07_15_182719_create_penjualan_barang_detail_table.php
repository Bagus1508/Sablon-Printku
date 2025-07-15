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
        Schema::create('penjualan_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pb');
            $table->unsignedBigInteger('id_produk');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->float('jumlah');
            $table->float('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_barang_detail');
    }
};
