<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Footer;
use App\Models\FacultyData;
use Illuminate\Http\Request;
use App\Models\Prestasi;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $faculties = FacultyData::all();
    
        $contact = Contact::first(); 
        $footers = Footer::with('listFooters')->get();
    
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
    
        if ($request->faculty_id) {
            $query->whereHas('mahasiswa.prodi', function ($q) use ($request) {
                $q->where('faculty', $request->faculty_id);
            });
        }
    
        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('NIM', 'like', '%' . $request->search . '%')
                   ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }
    
        $prestasi = $query->paginate(25); 
    
        return view('home', compact('faculties', 'prestasi', 'contact', 'footers'));
    }
    

    public function getPrestasiAjax(Request $request)
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

        if ($request->faculty_id) {
            $query->whereHas('mahasiswa.prodi', function ($q) use ($request) {
                $q->where('faculty', $request->faculty_id);
            });
        }
    
        if ($request->search) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('NIM', 'like', '%' . $request->search . '%')
                   ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category_id) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }
    
        if ($request->startMonth && $request->endMonth) {
            $query->whereBetween('tanggal_mulai', [$request->startMonth . '-01', $request->endMonth . '-31']);
        }
    
        $prestasi = $query->paginate(10); 
        
        $pagination = view('vendor.pagination.custom', ['prestasi' => $prestasi])->render();
        return response()->json([
            'prestasi' => $prestasi->items(),
            'pagination' => $pagination,
        ]);
    }
    
}
