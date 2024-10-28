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
        Schema::create('produk_kontrak_rinci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->unsignedBigInteger('id_kontrak_global');
            $table->unsignedBigInteger('id_produk');
            $table->integer('kuantitas')->nullable();
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->decimal('harga_barang', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_kontrak_rinci')
                    ->references('id')
                    ->on('kontrak_rinci_table')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('id_kontrak_global')
                    ->references('id')
                    ->on('kontrak_global')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('id_satuan')->references('id')->on('satuan_table');
            $table->foreign('id_produk')->references('id')->on('produk_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_kontrak_rinci');
    }
};
