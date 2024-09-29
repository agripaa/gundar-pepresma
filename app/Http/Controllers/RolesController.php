<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function index()
    {
        return Roles::all();
    }

    public function show($id)
    {
        return Roles::find($id);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name_role' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        Roles::create([
            'name_role' => strtoupper($request->name_role),
        ]);

        return redirect('/data/role')->with('success', 'Role berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        $role->update($request->all());
        return response()->json($role, 200);
    }

    public function destroy($id)
    {
        Roles::destroy($id);
        return response()->json(null, 204);
    }
}
