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
        Schema::table('stok_harian_table', function (Blueprint $table) {
            $table->decimal('used_meter')->nullable();
            $table->decimal('roll_length')->nullable();
            $table->decimal('used_rolls')->nullable();
            $table->decimal('remaining_meter')->nullable();
            $table->decimal('remaining_rolls')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_harian', function (Blueprint $table) {
            //
        });
    }
};
