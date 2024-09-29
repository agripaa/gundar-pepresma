<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianJuara extends Model
{
    use HasFactory;

    protected $table = 'capaian_juara'; 
    protected $fillable = ['jenis_juara'];
}
