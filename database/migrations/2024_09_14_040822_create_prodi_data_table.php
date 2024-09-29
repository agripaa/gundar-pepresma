<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdiDataTable extends Migration
{
    public function up()
    {
        Schema::create('prodi_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty')->constrained('faculty_data');
            $table->string('study_program', 125);
            $table->bigInteger('study_program_code');
            $table->string('study_program_level', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodi_data');
    }
}
