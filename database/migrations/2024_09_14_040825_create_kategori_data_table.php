<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriDataTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_data', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_data');
    }
}
