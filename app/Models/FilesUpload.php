<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesUpload extends Model
{
    use HasFactory;

    protected $table = 'files_upload';

    protected $fillable = [
        'url_certificate',
        'url_surat_tugas',
        'url_upp',
        'url_rekomendasi',
    ];
}
