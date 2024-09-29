<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiData extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty', 
        'study_program', 
        'study_program_code', 
        'study_program_level'
    ];

    // Definisi relasi ke model FacultyData
    public function facultyRelation()
    {
        return $this->belongsTo(FacultyData::class, 'faculty', 'id');
    }

    // Definisi relasi ke mahasiswa
    public function prodi()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }
}
