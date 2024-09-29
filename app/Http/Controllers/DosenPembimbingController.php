<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use Illuminate\Http\Request;

class DosenPembimbingController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');
    
        $dosenPembimbing = DosenPembimbing::when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                             ->orWhere('NIDN', 'like', '%' . $search . '%');
            })
            ->paginate(10);
    
        return view('tambah-dospem', compact('dosenPembimbing', 'search'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:125',
            'nidn' => 'required|numeric',
            'nip' => 'required|numeric',
            'nuptk' => 'required|numeric',
        ]);

        DosenPembimbing::create([
            'nama' => strtoupper($request->nama),
            'NIDN' => $request->nidn,
            'NIP' => $request->nip,
            'NUPTK' => $request->nuptk,
        ]);

        return redirect()->route('tambah-dospem')->with('success', 'Dosen Pembimbing berhasil ditambahkan!');
    }
    public function getDosenDetails($id)
    {
        $dosen = DosenPembimbing::find($id);
        
        if (!$dosen) {
            return response()->json(['error' => 'Dosen not found'], 404);
        }

        return response()->json([
            'NIDN' => $dosen->NIDN,
        ]);
    }

    public function edit($id)
    {
        $dosen = DosenPembimbing::findOrFail($id);
        return view('edit-dospem', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:125',
            'nidn' => 'required|numeric',
            'nip' => 'required|numeric',
            'nuptk' => 'required|numeric',
        ]);

        $dosen = DosenPembimbing::findOrFail($id);
        $dosen->update([
            'nama' => strtoupper($request->nama),
            'NIDN' => $request->nidn,
            'NIP' => $request->nip,
            'NUPTK' => $request->nuptk,
        ]);

        return redirect()->route('tambah-dospem')->with('success', 'Dosen Pembimbing berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dosen = DosenPembimbing::findOrFail($id);
        $dosen->delete();

        return redirect()->route('tambah-dospem')->with('success', 'Dosen Pembimbing berhasil dihapus!');
    }
}
