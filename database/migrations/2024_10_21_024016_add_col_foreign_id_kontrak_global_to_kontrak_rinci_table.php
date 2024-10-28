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
        Schema::table('kontrak_rinci_table', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kontrak_global')->nullable();
            $table->foreign('id_kontrak_global')->references('id')->on('kontrak_global')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontrak_rinci', function (Blueprint $table) {
            //
        });
    }
};
