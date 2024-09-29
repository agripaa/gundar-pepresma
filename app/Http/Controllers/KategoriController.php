<?php

namespace App\Http\Controllers;

use App\Models\KategoriData;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        KategoriData::create([
            'kategori' => strtoupper($request->kategori),
        ]);

        return redirect('/tambah-master-data')->with('success', 'Kategori berhasil ditambahkan!');
    }
    // Metode untuk edit, update, dan delete di semua controller lainnya
    public function edit($id)
    {
        $kategori = KategoriData::findOrFail($id); // Sesuaikan dengan KategoriData yang digunakan
        return view('edit-kategori-data', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:50', // Ganti dengan field yang sesuai
        ]);

        $data = KategoriData::findOrFail($id);
        $data->update([
            'kategori' => strtoupper($request->input('kategori')),
        ]);

        return redirect()->route('list-master-data')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KategoriData::findOrFail($id)->delete();
        return redirect()->route('list-master-data')->with('success', 'Data berhasil dihapus!');
    }

}
