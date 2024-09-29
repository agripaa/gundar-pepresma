<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsersTable extends Migration
{
    public function up()
    {
        Schema::create('profile_user', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 255);
            $table->string('image_name', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_user');
    }
}
