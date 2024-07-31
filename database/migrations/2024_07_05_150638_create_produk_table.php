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
        Schema::create('produk_table', function  (Blueprint $table){
            $table->id();
            $table->string('id_no');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_barang');
            $table->unsignedBigInteger('id_warna');
            $table->integer('total_panjang')->nullable();
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->unsignedBigInteger('id_ukuran')->nullable();
            $table->unsignedBigInteger('id_perusahaan')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('produk_kategori_table');
            $table->foreign('id_warna')->references('id')->on('data_warna_table');
            $table->foreign('id_satuan')->references('id')->on('satuan_table');
            $table->foreign('id_ukuran')->references('id')->on('ukuran_table');
            $table->foreign('id_perusahaan')->references('id')->on('perusahaan_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_table');
    }
};
