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
        Schema::create('invoice_table', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->bigInteger('nomor_invoice')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->string('resi_kirim_invoice')->nullable();
            $table->string('foto_invoice')->nullable();
            $table->date('tanggal_kirim_invoice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_table');
    }
};
