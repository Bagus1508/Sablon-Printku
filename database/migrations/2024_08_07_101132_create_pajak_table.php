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
        Schema::create('pajak_table', function (Blueprint $table) {
            $table->id(); // Kolom id dengan auto_increment dan primary key
            $table->unsignedTinyInteger('ppn'); // Kolom ppn sebagai unsigned tiny integer
            $table->timestamps(); // Kolom created_at dan updated_at
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppn');
    }
};
