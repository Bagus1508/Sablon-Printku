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
        Schema::create('proses_pekerjaan_table', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->string('tipe_proses',50);
            $table->date('tanggal_masuk');
            $table->date('tanggal_selesai');
            $table->integer('durasi');

            $table->foreign('id_kontrak_rinci')->references('id')->on('kontrak_rinci_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_pekerjaan_table');
    }
};
