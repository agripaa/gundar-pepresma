<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'NIM', 
        'nama', 
        'faculty', 
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(ProdiData::class, 'prodi_id');
    }

    // Relasi ke model Prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'data_mahasiswa');
    }

}
