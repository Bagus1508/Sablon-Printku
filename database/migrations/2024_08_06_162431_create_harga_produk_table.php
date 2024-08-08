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
        Schema::create('harga_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stok_harian');
            $table->decimal('harga_produksi_satuan', 15, 2)->nullable();
            $table->decimal('harga_beli_satuan', 15, 2)->nullable();
            $table->decimal('harga_jual_satuan', 15, 2)->nullable();
            $table->decimal('total_harga_jual', 15, 2)->nullable();
            $table->decimal('total_harga_produksi', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_stok_harian')->references('id')->on('stok_harian_table')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_produk');
    }
};
