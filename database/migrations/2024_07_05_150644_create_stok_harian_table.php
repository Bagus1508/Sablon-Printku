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
        Schema::create('stok_harian_table', function (Blueprint $table){
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_produk');
            $table->integer('stok_masuk');
            $table->integer('stok_keluar');
            $table->integer('sisa_stok');
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->unsignedBigInteger('id_ukuran')->nullable();
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk_table');
            $table->foreign('id_satuan')->references('id')->on('satuan_table');
            $table->foreign('id_ukuran')->references('id')->on('ukuran_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_harian_table');
    }
};
