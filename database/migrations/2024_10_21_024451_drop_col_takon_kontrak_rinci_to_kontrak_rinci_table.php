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
            $table->dropColumn('takon');
            $table->dropColumn('no_kontrak_pihak_pertama');
            $table->dropColumn('tanggal_kontrak');
            $table->dropColumn('no_telepon');
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
