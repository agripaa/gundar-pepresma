<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyDataTable extends Migration
{
    public function up()
    {
        Schema::create('faculty_data', function (Blueprint $table) {
            $table->id();
            $table->string('name_faculty', 80);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faculty_data');
    }
}
