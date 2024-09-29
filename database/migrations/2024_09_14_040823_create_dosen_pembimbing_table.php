<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPembimbingTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 125);
            $table->bigInteger('NIDN');
            $table->bigInteger('NIP');
            $table->bigInteger('NUPTK');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembimbing');
    }
}
