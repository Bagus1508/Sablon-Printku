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
        Schema::create('permintaan_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pr');
            $table->string('nama_barang');
            $table->string('spesifikasi_barang');
            $table->string('satuan');
            $table->float('jumlah');
            $table->string('alasan_kebutuhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang_detail');
    }
};
