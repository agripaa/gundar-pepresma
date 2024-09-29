<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $table = 'dosen_pembimbing'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'nama', 'NIDN', 'NIP', 'NUPTK',
    ];

    // Relasi ke model Prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'data_dospen');
    }
}
