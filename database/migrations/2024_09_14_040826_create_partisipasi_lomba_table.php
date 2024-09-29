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
        Schema::create('partisipan_lomba', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_partisipan_negara');
            $table->integer('jumlah_partisipan_peserta');
            $table->integer('jumlah_partisipan_team');
            $table->integer('jumlah_partisipan_kampus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partisipan_lomba');
    }
};
