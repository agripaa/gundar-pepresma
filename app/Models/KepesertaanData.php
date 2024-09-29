<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prestasi;

class KepesertaanData extends Model
{
    use HasFactory;

    protected $table = 'kepesertaan_data';

    protected $fillable = ['jenis_kepesertaan'];

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'kepesertaan_lomba');
    } 
}
