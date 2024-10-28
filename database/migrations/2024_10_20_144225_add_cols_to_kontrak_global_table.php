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
        Schema::table('kontrak_global', function (Blueprint $table) {
            $table->string('takon', 100);
            $table->string('no_kontrak_pihak_pertama');
            $table->string('no_telepon');
            $table->date('tanggal_kontrak');
            $table->date('tanggal_kr')->nullable();
            $table->date('awal_kr')->nullable();
            $table->date('akhir_kr')->nullable();
            $table->string('uraian')->nullable();
            $table->string('total_harga',15,2)->nullable();
            $table->unsignedBigInteger('id_perusahaan')->nullable();

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontrak_global', function (Blueprint $table) {
            //
        });
    }
};
