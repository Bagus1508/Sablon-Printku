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
        Schema::create('pengiriman_barang_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_permintaan_barang');
            $table->string('no_surat_jalan')->nullable();
            $table->date('tanggal_surat_jalan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->unsignedBigInteger('id_ekspedisi')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_barang_table');
    }
};
