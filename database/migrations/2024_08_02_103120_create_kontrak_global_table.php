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
        Schema::create('kontrak_global', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrak_rinci');
            $table->date('tanggal_spk')->nullable();
            $table->boolean('status_spk');
            $table->timestamps();

            $table->foreign('id_kontrak_rinci')->references('id')->on('kontrak_rinci_table')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_global');
    }
};
