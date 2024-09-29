<?php

namespace App\Http\Controllers;

use App\Models\KepesertaanData;
use Illuminate\Http\Request;

class KepesertaanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_kepesertaan' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        KepesertaanData::create([
            'jenis_kepesertaan' => strtoupper($request->jenis_kepesertaan),
        ]);

        return redirect('/tambah-master-data')->with('success', 'Jenis Kepesertaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kepesertaan = KepesertaanData::findOrFail($id);
        return view('edit-kepesertaan-data', compact('kepesertaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kepesertaan' => 'required|string|max:50',
        ]);

        $kepesertaan = KepesertaanData::findOrFail($id);
        $kepesertaan->update([
            'jenis_kepesertaan' => strtoupper($request->jenis_kepesertaan),
        ]);

        return redirect()->route('list-master-data')->with('success', 'Jenis Kepesertaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KepesertaanData::findOrFail($id)->delete();
        return redirect()->route('list-master-data')->with('success', 'Jenis Kepesertaan berhasil dihapus!');
    }
}
