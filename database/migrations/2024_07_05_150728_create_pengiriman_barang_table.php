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
        Schema::create('pengiriman_barang_table', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->string('no_surat_jalan')->nullable();
            $table->date('tanggal_surat_jalan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->unsignedBigInteger('id_ekspedisi')->nullable();
            $table->timestamps();

            $table->foreign('id_kontrak_rinci')->references('id')->on('kontrak_rinci_table');
            $table->foreign('id_ekspedisi')->references('id')->on('data_ekspedisi_table');
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
