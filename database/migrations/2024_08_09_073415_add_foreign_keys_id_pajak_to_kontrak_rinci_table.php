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
            $table->unsignedBigInteger('id_pajak')->nullable();
            $table->foreign('id_pajak')->references('id')->on('pajak_table');
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
