<?php


namespace App\Http\Controllers;

use App\Models\PrestasiData;
use Illuminate\Http\Request;

class PrestasiLombaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'prestasi' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        PrestasiData::create([
            'prestasi' => strtoupper($request->prestasi),
        ]);

        return redirect('/tambah-master-data')->with('success', 'Jenis Prestasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $prestasi = PrestasiData::findOrFail($id); 
        return view('edit-prestasi-data', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prestasi' => 'required|string|max:50', 
        ]);

        $data = PrestasiData::findOrFail($id);
        $data->update([
            'prestasi' => strtoupper($request->input('prestasi')),
        ]);

        return redirect()->route('list-master-data')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PrestasiData::findOrFail($id)->delete();
        return redirect()->route('list-master-data')->with('success', 'Data berhasil dihapus!');
    }
}
