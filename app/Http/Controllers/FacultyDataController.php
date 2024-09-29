<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultyData;

class FacultyDataController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');
    
        $faculties = FacultyData::when($search, function ($query, $search) {
                return $query->where('name_faculty', 'like', '%' . $search . '%');
            })
            ->paginate(10);
    
        return view('tambah-fakultas', compact('faculties', 'search'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name_faculty' => 'required|string|max:100',
        ]);

        FacultyData::create([
            'name_faculty' => strtoupper($request->name_faculty),
        ]);

        return redirect()->route('tambah-fakultas')->with('success', 'Fakultas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $faculty = FacultyData::findOrFail($id);
        $faculties = FacultyData::all(); 
        return view('edit-fakultas', compact('faculty', 'faculties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_faculty' => 'required|string|max:100',
        ]);

        $faculty = FacultyData::findOrFail($id);
        $faculty->update([
            'name_faculty' => strtoupper($request->name_faculty),
        ]);

        return redirect()->route('tambah-fakultas')->with('success', 'Fakultas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $faculty = FacultyData::findOrFail($id);
        $faculty->delete();

        return redirect()->route('tambah-fakultas')->with('success', 'Fakultas berhasil dihapus!');
    }
}
