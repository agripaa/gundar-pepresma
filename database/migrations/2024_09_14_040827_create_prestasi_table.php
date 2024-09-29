<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan', 255);
            $table->string('judul_karya', 255);
            $table->string('lokasi_kegiatan', 255);
            $table->string('penyelenggara', 125);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_penyelenggara', 255);
            $table->string('nomor_surat_tugas', 255);
            $table->date('tanggal_surat_tugas');
            $table->text('keterangan')->nullable();
            $table->foreignId('kepesertaan_lomba')->constrained('kepesertaan_data');
            $table->foreignId('kategori_lomba')->constrained('kategori_data');
            $table->foreignId('jenis_prestasi')->constrained('prestasi_data');
            $table->foreignId('kategori_juara')->constrained('capaian_juara');
            $table->foreignId('detail_partisipan')->constrained('partisipan_lomba');
            $table->foreignId('posisi_peserta')->constrained('posisi_data');
            $table->foreignId('data_mahasiswa')->constrained('mahasiswa');
            $table->foreignId('data_dospen')->constrained('dosen_pembimbing');
            $table->foreignId('file_upload')->constrained('files_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
