<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesUploadTable extends Migration
{
    public function up()
    {
        Schema::create('files_upload', function (Blueprint $table) {
            $table->id();
            $table->string('url_certificate', 255);
            $table->string('url_surat_tugas', 255);
            $table->string('url_upp', 255);
            $table->string('url_rekomendasi', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files_upload');
    }
}
