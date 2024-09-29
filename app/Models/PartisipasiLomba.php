<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartisipasiLomba extends Model
{
    use HasFactory;

    protected $table = 'partisipan_lomba';

    protected $fillable = [
        'jumlah_partisipan_negara', 
        'jumlah_partisipan_peserta', 
        'jumlah_partisipan_team', 
        'jumlah_partisipan_kampus',
    ];
}
