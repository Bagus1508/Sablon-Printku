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
        Schema::create('monitoring_global_table', function(Blueprint $table){
            $table->id();
            $table->string('takon')->nullable();
            $table->string('pihak_pertama')->nullable();
            $table->date('tanggal');
            $table->unsignedBigInteger('id_perusahaan');
            $table->text('uraian_pekerjaan')->nullable();
            $table->decimal('harga', 15,2);
            $table->string('nama_barang')->nullable();
            $table->float('volume')->nullable();
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->float('kontrak')->nullable();
            $table->float('realisasi')->nullable();
            $table->float('sisa');
            $table->string('awal');
            $table->string('akhir');
            $table->string('spk_selesai');

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan_table');
            $table->foreign('id_satuan')->references('id')->on('satuan_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_global_table');
    }
};
