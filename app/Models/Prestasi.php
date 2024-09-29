<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'nama_kegiatan',
        'judul_karya',
        'lokasi_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'penyelenggara',
        'nama_penyelenggara',
        'kepesertaan_lomba',
        'kategori_lomba',
        'jenis_prestasi',
        'kategori_juara',
        'posisi_peserta',
        'data_mahasiswa',
        'data_dospen',
        'detail_partisipan',
        'file_upload',
        'nomor_surat_tugas',
        'tanggal_surat_tugas',
        'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'data_mahasiswa');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'data_dospen');
    }

    public function kepesertaan()
    {
        return $this->belongsTo(KepesertaanData::class, 'kepesertaan_lomba');
    }    
    
    public function kategori()
    {
        return $this->belongsTo(KategoriData::class, 'kategori_lomba');
    }

    public function jenisPrestasi()
    {
        return $this->belongsTo(PrestasiData::class, 'jenis_prestasi');
    }

    public function capaian()
    {
        return $this->belongsTo(CapaianJuara::class, 'kategori_juara');
    }

    public function posisi()
    {
        return $this->belongsTo(PosisiData::class, 'posisi_peserta');
    }

    public function fileUpload()
    {
        return $this->hasOne(FilesUpload::class, 'id', 'file_upload');
    }
    
    public function partisipan()
    {
        return $this->belongsTo(PartisipasiLomba::class, 'detail_partisipan');
    }
}
