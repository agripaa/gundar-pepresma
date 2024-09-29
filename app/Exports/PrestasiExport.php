<?php

namespace App\Exports;

use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrestasiExport implements FromCollection, WithHeadings
{
    protected $prestasi;

    public function __construct($prestasi)
    {
        $this->prestasi = $prestasi;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->prestasi->map(function ($p) {
            // Generate full URLs for file uploads
            $baseUrl = URL::to('/'); // Get the base URL for the application

            $certificateUrl = $p->fileUpload && $p->fileUpload->url_certificate 
                ? $baseUrl . Storage::url($p->fileUpload->url_certificate) 
                : '-';
            $suratTugasUrl = $p->fileUpload && $p->fileUpload->url_surat_tugas 
                ? $baseUrl . Storage::url($p->fileUpload->url_surat_tugas) 
                : '-';
            $uppUrl = $p->fileUpload && $p->fileUpload->url_upp 
                ? $baseUrl . Storage::url($p->fileUpload->url_upp) 
                : '-';
            $rekomendasiUrl = $p->fileUpload && $p->fileUpload->url_rekomendasi 
                ? $baseUrl . Storage::url($p->fileUpload->url_rekomendasi) 
                : '-';

            return [
                'NIM' => $p->mahasiswa->NIM ?? '-',
                'Nama' => $p->mahasiswa->nama ?? '-',
                'Prodi' => $p->mahasiswa->prodi->study_program ?? '-',
                'Kepesertaan' => $p->kepesertaan->jenis_kepesertaan ?? '-',
                'Kategori' => $p->kategori->kategori ?? '-',
                'Jumlah Partisipasi Negara' => $p->partisipan->jumlah_partisipan_negara ?? '-',
                'Jumlah Partisipasi Peserta' => $p->partisipan->jumlah_partisipan_peserta ?? '-',
                'Jumlah Partisipasi Team' => $p->partisipan->jumlah_partisipan_team ?? '-',
                'Jumlah Partisipasi Perguruan Tinggi' => $p->partisipan->jumlah_partisipan_kampus ?? '-',
                'Jenis Prestasi' => $p->jenisPrestasi->prestasi ?? '-',
                'Nama Kegiatan' => $p->nama_kegiatan,
                'Judul Program' => $p->judul_karya,
                'Lokasi Kegiatan' => $p->lokasi_kegiatan,
                'Tanggal Mulai' => $p->tanggal_mulai,
                'Tanggal Selesai' => $p->tanggal_selesai,
                'Nama Penyelenggara' => $p->nama_penyelenggara,
                'Pencapaian' => $p->capaian->jenis_juara ?? '-',
                'Posisi' => $p->posisi->posisi ?? '-',
                'Dosen Pendamping' => $p->dosenPembimbing->nama ?? '-',
                'NIDN' => $p->dosenPembimbing->NIDN ?? '-',
                'Publikasi' => $p->penyelenggara,
                'No. Surat Tugas' => $p->nomor_surat_tugas,
                'Tanggal Surat Tugas' => $p->tanggal_surat_tugas,
                'Certificate URL' => $certificateUrl,
                'Surat Tugas URL' => $suratTugasUrl,
                'UPP URL' => $uppUrl,
                'Rekomendasi URL' => $rekomendasiUrl,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIM', 'Nama', 'Prodi', 'Kepesertaan', 'Kategori', 'Jumlah Partisipasi Negara', 'Jumlah Partisipasi Peserta', 'Jumlah Partisipasi Team', 'Jumlah Partisipasi Perguruan Tinggi','Jenis Prestasi', 'Nama Kegiatan',
            'Judul Program', 'Lokasi Kegiatan', 'Tanggal Mulai', 'Tanggal Selesai', 'Nama Penyelenggara',
            'Pencapaian', 'Posisi', 'Dosen Pendamping', 'NIDN', 'Publikasi', 'No. Surat Tugas', 'Tanggal Surat Tugas',
            'Certificate URL', 'Surat Tugas URL', 'UPP URL', 'Rekomendasi URL'
        ];
    }
}
