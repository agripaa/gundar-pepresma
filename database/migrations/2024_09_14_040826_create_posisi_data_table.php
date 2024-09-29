<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosisiDataTable extends Migration
{
    public function up()
    {
        Schema::create('posisi_data', function (Blueprint $table) {
            $table->id();
            $table->string('posisi', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posisi_data');
    }
}
