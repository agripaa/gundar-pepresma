<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_faculty',
    ];

    // Definisi relasi ke prodi
    public function prodi()
    {
        return $this->hasMany(ProdiData::class, 'faculty', 'id');
    }
}
