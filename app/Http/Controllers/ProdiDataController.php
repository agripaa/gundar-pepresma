<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdiData;
use App\Models\FacultyData;

class ProdiDataController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');
    
        $prodis = ProdiData::with('facultyRelation')
            ->when($search, function ($query, $search) {
                return $query->where('study_program', 'like', '%' . $search . '%')
                             ->orWhere('study_program_code', 'like', '%' . $search . '%');
            })
            ->paginate(10);
    
        $faculties = FacultyData::all(); 

        return view('tambah-prodi', compact('faculties', 'prodis', 'search'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'study_program' => 'required|string|max:255',
            'study_program_code' => 'required|string|max:10',
            'study_program_level' => 'required|string',
            'faculty' => 'required|exists:faculty_data,id',
        ]);

        ProdiData::create([
            'study_program' => strtoupper($request->study_program),
            'study_program_code' => strtoupper($request->study_program_code),
            'study_program_level' => $request->study_program_level,
            'faculty' => $request->faculty,
        ]);

        return redirect()->route('tambah-prodi')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $prodi = ProdiData::findOrFail($id);
        $faculties = FacultyData::all();
        $prodis = ProdiData::with('facultyRelation')->get();

        return view('edit-prodi', compact('prodi', 'faculties', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'study_program' => 'required|string|max:255',
            'study_program_code' => 'required|string|max:10',
            'study_program_level' => 'required|string',
            'faculty' => 'required|exists:faculty_data,id',
        ]);

        $prodi = ProdiData::findOrFail($id);
        $prodi->update([
            'study_program' => strtoupper($request->study_program),
            'study_program_code' => strtoupper($request->study_program_code),
            'study_program_level' => $request->study_program_level,
            'faculty' => $request->faculty,
        ]);

        return redirect()->route('tambah-prodi')->with('success', 'Program Studi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prodi = ProdiData::findOrFail($id);
        $prodi->delete();

        return redirect()->route('tambah-prodi')->with('success', 'Program Studi berhasil dihapus!');
    }
}
