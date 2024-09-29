<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiData extends Model
{
    use HasFactory;

    protected $fillable = ['prestasi'];

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'jenis_prestasi');
    }
}
