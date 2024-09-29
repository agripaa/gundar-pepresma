<?php

namespace App\Http\Controllers;
use App\Models\PosisiData;
use Illuminate\Http\Request;

class PosisiDataController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'posisi' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        PosisiData::create([
            'posisi' => strtoupper($request->posisi),
        ]);

        return redirect('/tambah-master-data')->with('success', 'Jenis Prestasi berhasil ditambahkan!');
    }
    // Metode untuk edit, update, dan delete di semua controller lainnya
    public function edit($id)
    {
        $posisi = PosisiData::findOrFail($id); // Sesuaikan dengan PosisiData yang digunakan
        return view('edit-posisi-data', compact('posisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi' => 'required|string|max:50', // Ganti dengan field yang sesuai
        ]);

        $data = PosisiData::findOrFail($id);
        $data->update([
            'posisi' => strtoupper($request->input('posisi')),
        ]);

        return redirect()->route('list-master-data')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PosisiData::findOrFail($id)->delete();
        return redirect()->route('list-master-data')->with('success', 'Data berhasil dihapus!');
    }
}
