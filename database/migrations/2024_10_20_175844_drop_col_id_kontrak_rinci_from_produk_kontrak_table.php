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
        Schema::table('produk_kontrak', function (Blueprint $table) {
            $table->dropForeign(['id_kontrak_rinci']);
            $table->dropColumn('id_kontrak_rinci');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_kontrak', function (Blueprint $table) {
            //
        });
    }
};
