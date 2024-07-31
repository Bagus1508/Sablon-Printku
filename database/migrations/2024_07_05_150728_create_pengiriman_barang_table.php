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
            $table->string('region');
            $table->string('no_surat_jalan');
            $table->date('tanggal_surat_jalan');
            $table->string('bukti_foto')->nullable();
            $table->unsignedBigInteger('id_ekspedisi')->nullable();
            $table->string('ba_rikmatek')->nullable();
            $table->date('tanggal_ba_rikmatek')->nullable();
            $table->string('bapb_bapp')->nullable();
            $table->integer('no_bapb_bapp')->nullable();
            $table->date('tanggal_bapb_bapp')->nullable();
            $table->string('bast')->nullable();
            $table->integer('no_bast')->nullable();
            $table->date('tanggal_bast')->nullable();

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
