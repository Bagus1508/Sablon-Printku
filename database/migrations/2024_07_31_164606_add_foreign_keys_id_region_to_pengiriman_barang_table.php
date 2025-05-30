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
        Schema::table('pengiriman_barang_table', function (Blueprint $table) {
            $table->unsignedBigInteger('id_region')->nullable();
            $table->foreign('id_region')->references('id')->on('region_table')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengiriman_barang', function (Blueprint $table) {
            //
        });
    }
};
