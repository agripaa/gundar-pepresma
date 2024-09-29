<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultyData;
use App\Models\ProdiData;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Menampilkan form untuk menambah data mahasiswa
    public function create(Request $request)
    {
        $faculties = FacultyData::all();
    
        // Ambil parameter search jika ada
        $search = $request->input('search');
    
        // Query mahasiswa dengan pagination dan search
        $mahasiswa = Mahasiswa::with('prodi')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                             ->orWhere('NIM', 'like', '%' . $search . '%');
            })
            ->paginate(10);
    
        return view('tambah-mahasiswa', compact('faculties', 'mahasiswa', 'search'));
    }
    

    // Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'NIM' => 'required|integer',
            'nama' => 'required|string|max:125',
            'faculty_id' => 'required|exists:faculty_data,id',
            'prodi_id' => 'required|exists:prodi_data,id',
        ]);

        Mahasiswa::create([
            'NIM' => $request->NIM,
            'nama' => strtoupper($request->nama),
            'faculty' => $request->faculty_id,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('tambah-mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $faculties = FacultyData::all();
        $prodis = ProdiData::where('faculty', $mahasiswa->faculty)->get();

        return view('edit-mahasiswa', compact('mahasiswa', 'faculties', 'prodis'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'NIM' => 'required|integer',
            'nama' => 'required|string|max:125',
            'faculty_id' => 'required|exists:faculty_data,id',
            'prodi_id' => 'required|exists:prodi_data,id',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'NIM' => $request->NIM,
            'nama' => strtoupper($request->nama),
            'faculty' => $request->faculty_id,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('tambah-mahasiswa')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('tambah-mahasiswa')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }

    public function getProdiByFaculty($facultyId)
    {
        $prodi_id = ProdiData::where('faculty', $facultyId)->get();
        return response()->json($prodi_id);
    }
}
