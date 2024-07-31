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
        Schema::create('proses_jahit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('durasi')->nullable();
            $table->timestamps();

            $table->foreign('id_kontrak_rinci')->references('id')->on('kontrak_rinci_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_jahit');
    }
};
