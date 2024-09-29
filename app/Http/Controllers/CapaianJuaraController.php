<?php

namespace App\Http\Controllers;

use App\Models\CapaianJuara;
use Illuminate\Http\Request;

class CapaianJuaraController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_juara' => 'required|string|max:50',
        ]);

        CapaianJuara::create([
            'jenis_juara' => strtoupper($request->jenis_juara),
        ]);

        return redirect('/tambah-master-data')->with('success', 'Jenis Juara berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $capaianJuara = CapaianJuara::findOrFail($id);
        return view('edit-juara-data', compact('capaianJuara'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_juara' => 'required|string|max:50',
        ]);

        $data = CapaianJuara::findOrFail($id);
        $data->update([
            'jenis_juara' => strtoupper($request->input('jenis_juara')),
        ]);

        return redirect()->route('list-master-data')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        CapaianJuara::findOrFail($id)->delete();
        return redirect()->route('list-master-data')->with('success', 'Data berhasil dihapus!');
    }

}
