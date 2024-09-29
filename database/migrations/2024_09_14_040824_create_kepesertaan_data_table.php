<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepesertaanDataTable extends Migration
{
    public function up()
    {
        Schema::create('kepesertaan_data', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kepesertaan', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kepesertaan_data');
    }
}
