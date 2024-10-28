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
        Schema::table('produk_kontrak_rinci', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk_kontrak_global')->nullable();
            $table->foreign('id_produk_kontrak_global')->references('id')->on('produk_kontrak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_kontrak_rinci', function (Blueprint $table) {
            //
        });
    }
};
