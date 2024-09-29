<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiDataTable extends Migration
{
    public function up()
    {
        Schema::create('prestasi_data', function (Blueprint $table) {
            $table->id();
            $table->string('prestasi', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasi_data');
    }
}
