<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\CapaianJuara;
use App\Models\FilesUpload;
use App\Models\PosisiData;
use App\Models\KepesertaanData;
use App\Models\KategoriData;
use App\Models\PartisipasiLomba;
use App\Models\FacultyData;
use App\Models\PrestasiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrestasiExport;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource with filters.
     */
    public function index(Request $request)
    {
        $faculties = FacultyData::all();
        $categories = KategoriData::all();

        // Using pagination to fetch 50 records per page
        $prestasi = Prestasi::with([
            'mahasiswa', 
            'mahasiswa.prodi',
            'dosenPembimbing', 
            'kepesertaan', 
            'kategori', 
            'jenisPrestasi', 
            'capaian', 
            'posisi', 
            'fileUpload',
            'partisipan'
        ])->paginate(2); // Paginate with 50 items per page

        return view('list-prestasi', compact('prestasi', 'faculties', 'categories'));
    }

    public function create()
    {
        $faculties = FacultyData::all();
        $kategori = KategoriData::all();
        $kepesertaan = KepesertaanData::all();
        $jenisPrestasi = PrestasiData::all();
        $capaianJuara = CapaianJuara::all();
        $posisi = PosisiData::all();
        $mahasiswa = Mahasiswa::all();
        $dospem = DosenPembimbing::all();

        return view('tambah-prestasi', compact('faculties', 'kategori', 'kepesertaan', 'jenisPrestasi', 'capaianJuara', 'posisi', 'mahasiswa', 'dospem'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'judul_karya' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nama_penyelenggara' => 'required|string|max:125',
            'publikasi' => 'required|string|max:125',
            'jumlah_negara' => 'required|int',
            'jumlah_peserta' => 'required|int',
            'jumlah_team' => 'required|int',
            'jumlah_perguruan_tinggi' => 'required|int',
            'no_surat_tugas' => 'required|string|max:255',
            'tgl_surat_tugas' => 'required|date',
            'kepesertaan_lomba' => 'required|exists:kepesertaan_data,id',
            'kategori_lomba' => 'required|exists:kategori_data,id',
            'jenis_prestasi' => 'required|exists:prestasi_data,id',
            'kategori_juara' => 'required|exists:capaian_juara,id',
            'posisi_peserta' => 'required|exists:posisi_data,id',
            'data_mahasiswa' => 'required|exists:mahasiswa,id',
            'data_dospen' => 'required|exists:dosen_pembimbing,id',
            'sertifikat' => 'required|file|mimes:pdf|max:2048',
            'surat_izin' => 'required|file|mimes:pdf|max:2048',
            'upp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rekomendasi' => 'required|file|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan file yang di-upload
        $sertifikatPath = $request->file('sertifikat')->store('prestasi_files', 'public');
        $suratIzinPath = $request->file('surat_izin')->store('prestasi_files', 'public');
        $uppPath = $request->file('upp')->store('prestasi_files', 'public');
        $rekomendasiPath = $request->file('rekomendasi')->store('prestasi_files', 'public');

        $file_upload = FilesUpload::create([
            'url_certificate' => $sertifikatPath,
            'url_surat_tugas' => $suratIzinPath,
            'url_upp' => $uppPath,
            'url_rekomendasi' => $rekomendasiPath
        ]);

        $partisipan_lomba = PartisipasiLomba::create([
            'jumlah_partisipan_negara' => $request->jumlah_negara,
            'jumlah_partisipan_peserta' => $request->jumlah_peserta,
            'jumlah_partisipan_team' => $request->jumlah_team,
            'jumlah_partisipan_kampus' => $request->jumlah_perguruan_tinggi,
        ]);

        // Convert input to uppercase before saving
        Prestasi::create([
            'nama_kegiatan' => strtoupper($request->nama_kegiatan),
            'judul_karya' => strtoupper($request->judul_karya),
            'lokasi_kegiatan' => strtoupper($request->lokasi_kegiatan),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'penyelenggara' => strtoupper($request->publikasi),
            'nama_penyelenggara' => strtoupper($request->nama_penyelenggara),
            'kepesertaan_lomba' => $request->kepesertaan_lomba,
            'kategori_lomba' => $request->kategori_lomba,
            'jenis_prestasi' => $request->jenis_prestasi,
            'kategori_juara' => $request->kategori_juara,
            'posisi_peserta' => $request->posisi_peserta,
            'data_mahasiswa' => $request->data_mahasiswa,
            'data_dospen' => $request->data_dospen,
            'detail_partisipan' => $partisipan_lomba->id,
            'file_upload' => $file_upload->id,
            'nomor_surat_tugas' => $request->no_surat_tugas,
            'tanggal_surat_tugas' => $request->tgl_surat_tugas,
            'keterangan' => $request->keterangan ? strtoupper($request->keterangan) : null,
        ]);

        return redirect()->route('tambah-prestasi')->with('success', 'Data Prestasi berhasil ditambahkan!');
    }

    /**
     * Get Prestasi Lampiran
     */
    public function getLampiran($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $file = FilesUpload::where('id', $prestasi->file_upload)->first();

        $fileDetails = [];

        if (Storage::disk('public')->exists($file->url_certificate)) {
            $fileDetails[] = [
                'url' => Storage::url($file->url_certificate),
                'type' => 'pdf',
                'name' => 'Certificate'
            ];
        }
        if (Storage::disk('public')->exists($file->url_surat_tugas)) {
            $fileDetails[] = [
                'url' => Storage::url($file->url_surat_tugas),
                'type' => 'pdf',
                'name' => 'Surat Tugas'
            ];
        }
        if (Storage::disk('public')->exists($file->url_upp)) {
            $fileDetails[] = [
                'url' => Storage::url($file->url_upp),
                'type' => 'image',
                'name' => 'UPP'
            ];
        }
        if (Storage::disk('public')->exists($file->url_rekomendasi)) {
            $fileDetails[] = [
                'url' => Storage::url($file->url_rekomendasi),
                'type' => 'pdf',
                'name' => 'Surat Rekomendasi'
            ];
        }

        // Tambahkan logging untuk memastikan fileDetails terisi
        Log::info('File Details:', $fileDetails);

        return response()->json(['files' => $fileDetails]);
    }
    
    /**
     * Fetch Prestasi data for table with filters
     */
    public function fetchPrestasi(Request $request)
    {
        // Query dasar untuk mendapatkan prestasi dengan relasi terkait
        $query = Prestasi::with([
            'mahasiswa', 
            'mahasiswa.prodi',
            'dosenPembimbing', 
            'kepesertaan', 
            'kategori', 
            'jenisPrestasi', 
            'capaian', 
            'posisi', 
            'fileUpload',
            'partisipan'
        ]);
    
        // Filter berdasarkan bulan dan tahun (tanggal mulai dan selesai event)
        if ($request->startMonth && $request->endMonth) {
            $startMonth = $request->startMonth . '-01';
            $endMonth = date("Y-m-t", strtotime($request->endMonth));
            $query->whereBetween('tanggal_selesai', [$startMonth, $endMonth]);
        }
    
        // Filter berdasarkan fakultas
        if ($request->faculty_id) {
            $query->whereHas('mahasiswa.prodi', function ($q) use ($request) {
                $q->where('faculty', $request->faculty_id);
            });
        }
    
        // Filter berdasarkan kategori lomba
        if ($request->category_id) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }
    
        // Filter berdasarkan NIM, Nama, Dosen Pembimbing, atau NIDN
        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('NIM', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('dosenPembimbing', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('NIDN', 'like', '%' . $request->search . '%');
            });
        }
    
        // Dapatkan hasil filtering
        $prestasi = $query->get();
    
        return response()->json($prestasi);
    }
    
    public function fetchPrestasiVisitor(Request $request)
    {
        // Query dasar untuk mendapatkan prestasi dengan relasi terkait
        $query = Prestasi::with([
            'mahasiswa', 
            'mahasiswa.prodi',
            'dosenPembimbing', 
            'kepesertaan', 
            'kategori', 
            'jenisPrestasi', 
            'capaian', 
            'posisi', 
            'fileUpload',
            'partisipan'
        ]);
    
        // Filter berdasarkan fakultas
        if ($request->faculty_id) {
            $query->whereHas('mahasiswa.prodi', function ($q) use ($request) {
                $q->where('faculty', $request->faculty_id);
            });
        }
    
        // Filter berdasarkan pencarian NIM atau Nama
        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('NIM', 'like', '%' . $request->search . '%')
                    ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }
    
        // Fetch hasil prestasi dengan paginasi
        $prestasi = $query->paginate(7); // Contoh paginasi dengan 7 item per halaman
    
        return view('list-prestasi', compact('prestasi'));
    }
    
    public function export(Request $request)
    {
        $query = Prestasi::with([
            'mahasiswa', 
            'mahasiswa.prodi',
            'dosenPembimbing', 
            'kepesertaan', 
            'kategori', 
            'jenisPrestasi', 
            'capaian', 
            'posisi', 
            'fileUpload',
            'partisipan'
        ]);
    
        // Apply filters only if they are present
        if ($request->startMonth && $request->endMonth) {
            $startMonth = $request->startMonth . '-01';
            $endMonth = date("Y-m-t", strtotime($request->endMonth));
            $query->whereBetween('tanggal_selesai', [$startMonth, $endMonth]);
        }
    
        if ($request->faculty_id) {
            $query->whereHas('mahasiswa.prodi', function ($q) use ($request) {
                $q->where('faculty', $request->faculty_id);
            });
        }
    
        if ($request->category_id) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }
    
        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('NIM', 'like', '%' . $request->search . '%')
                ->orWhere('nama', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('dosenPembimbing', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('NIDN', 'like', '%' . $request->search . '%');
            });
        }
    
        // Get the results based on whether there are filters or not
        $prestasi = $query->get(); // This will return all data if no filters are applied
    
        return Excel::download(new PrestasiExport($prestasi), 'prestasi-data.xlsx');
    }
    


    public function searchMahasiswa(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) >= 3) {
            $mahasiswa = Mahasiswa::where('nama', 'like', '%' . $query . '%')
                                ->orWhere('NIM', 'like', '%' . $query . '%')
                                ->with('prodi')
                                ->get()
                                ->map(function ($m) {
                                    return [
                                        'id' => $m->id,
                                        'nama' => $m->nama,
                                        'NIM' => $m->NIM,
                                        'prodi' => $m->prodi->study_program
                                    ];
                                });
                                
            return response()->json($mahasiswa);
        }

        return response()->json([]);
    }

    public function searchDospem(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) >= 3) {
            $dosen = DosenPembimbing::where('nama', 'like', '%' . $query . '%')
                                    ->orWhere('NIDN', 'like', '%' . $query . '%')
                                    ->get()
                                    ->map(function ($d) {
                                        return [
                                            'id' => $d->id,
                                            'nama' => $d->nama,
                                            'NIDN' => $d->NIDN
                                        ];
                                    });

            return response()->json($dosen);
        }

        return response()->json([]);
    }

    public function edit($id)
    {
        $prestasi = Prestasi::with(['mahasiswa', 'dosenPembimbing', 'kepesertaan', 'kategori', 'jenisPrestasi', 'capaian', 'posisi'])
                            ->findOrFail($id);

        $faculties = FacultyData::all();
        $kategori = KategoriData::all();
        $kepesertaan = KepesertaanData::all();
        $jenisPrestasi = PrestasiData::all();
        $capaianJuara = CapaianJuara::all();
        $posisi = PosisiData::all();
        $mahasiswa = Mahasiswa::all();
        $dospem = DosenPembimbing::all();
        $fileUpload = FilesUpload::all();

        return view('edit-prestasi', compact('prestasi', 'faculties', 'kategori', 'kepesertaan', 'jenisPrestasi', 'capaianJuara', 'posisi', 'mahasiswa', 'dospem', 'fileUpload'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'judul_karya' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nama_penyelenggara' => 'required|string|max:125',
            'publikasi' => 'required|string|max:125',
            'jumlah_negara' => 'required|int',
            'jumlah_peserta' => 'required|int',
            'jumlah_team' => 'required|int',
            'jumlah_perguruan_tinggi' => 'required|int',
            'no_surat_tugas' => 'required|string|max:255',
            'tgl_surat_tugas' => 'required|date',
            'kepesertaan_lomba' => 'required|exists:kepesertaan_data,id',
            'kategori_lomba' => 'required|exists:kategori_data,id',
            'jenis_prestasi' => 'required|exists:prestasi_data,id',
            'kategori_juara' => 'required|exists:capaian_juara,id',
            'posisi_peserta' => 'required|exists:posisi_data,id',
            'data_mahasiswa' => 'required|exists:mahasiswa,id', // Ensure mahasiswa field is validated
            'data_dospen' => 'required|exists:dosen_pembimbing,id', // Ensure dospen field is validated
            'sertifikat' => 'nullable|file|mimes:pdf|max:2048',
            'surat_izin' => 'nullable|file|mimes:pdf|max:2048',
            'upp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'rekomendasi' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Find the existing Prestasi record
        $prestasi = Prestasi::findOrFail($id);

        // Check if mahasiswa data has been updated
        if ($request->filled('data_mahasiswa')) {
            $prestasi->data_mahasiswa = $request->data_mahasiswa;
        }

        // Check if dosen data has been updated
        if ($request->filled('data_dospen')) {
            $prestasi->data_dospen = $request->data_dospen;
        }

        // Update other fields
        $prestasi->update([
            'nama_kegiatan' => strtoupper($request->nama_kegiatan),
            'judul_karya' => strtoupper($request->judul_karya),
            'lokasi_kegiatan' => strtoupper($request->lokasi_kegiatan),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'penyelenggara' => strtoupper($request->publikasi),
            'nama_penyelenggara' => strtoupper($request->nama_penyelenggara),
            'kepesertaan_lomba' => $request->kepesertaan_lomba,
            'kategori_lomba' => $request->kategori_lomba,
            'jenis_prestasi' => $request->jenis_prestasi,
            'kategori_juara' => $request->kategori_juara,
            'posisi_peserta' => $request->posisi_peserta,
            'data_mahasiswa' => $request->data_mahasiswa,
            'data_dospen' => $request->data_dospen,
            'nomor_surat_tugas' => $request->no_surat_tugas,
            'tanggal_surat_tugas' => $request->tgl_surat_tugas,
            'keterangan' => strtoupper($request->keterangan)
        ]);

        if ($request->hasFile('sertifikat')) {
            $sertifikatPath = $request->file('sertifikat')->store('prestasi_files', 'public');
            $prestasi->fileUpload()->update(['url_certificate' => $sertifikatPath]);
        }

        if ($request->hasFile('surat_izin')) {
            $suratIzinPath = $request->file('surat_izin')->store('prestasi_files', 'public');
            $prestasi->fileUpload()->update(['url_surat_tugas' => $suratIzinPath]);
        }

        if ($request->hasFile('upp')) {
            $uppPath = $request->file('upp')->store('prestasi_files', 'public');
            $prestasi->fileUpload()->update(['url_upp' => $uppPath]);
        }

        if ($request->hasFile('rekomendasi')) {
            $rekomendasiPath = $request->file('rekomendasi')->store('prestasi_files', 'public');
            $prestasi->fileUpload()->update(['url_rekomendasi' => $rekomendasiPath]);
        }

        return redirect()->route('list-prestasi')->with('success', 'Prestasi updated successfully!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
    
        $fileUpload = $prestasi->fileUpload;
        $prestasi->delete();
    
        if ($fileUpload) {
            if (Storage::disk('public')->exists($fileUpload->url_certificate)) {
                Storage::disk('public')->delete($fileUpload->url_certificate);
            }
            if (Storage::disk('public')->exists($fileUpload->url_surat_tugas)) {
                Storage::disk('public')->delete($fileUpload->url_surat_tugas);
            }
            if (Storage::disk('public')->exists($fileUpload->url_upp)) {
                Storage::disk('public')->delete($fileUpload->url_upp);
            }
            if (Storage::disk('public')->exists($fileUpload->url_rekomendasi)) {
                Storage::disk('public')->delete($fileUpload->url_rekomendasi);
            }
    
            $fileUpload->delete();
        }
    
        return redirect()->route('list-prestasi')->with('success', 'Prestasi successfully deleted!');
    }
}
