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
        Schema::table('data_warna_table', function (Blueprint $table) {
            $table->unsignedBigInteger('id_merek')->nullable();
            $table->foreign('id_merek')->references('id')->on('data_merek_table')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_warna_table', function (Blueprint $table) {
            //
        });
    }
};
