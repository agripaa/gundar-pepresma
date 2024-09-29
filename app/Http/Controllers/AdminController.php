<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // List all admins
    public function index()
    {
        $admins = User::where('role', 2)->get();
        return view('list-admin', compact('admins'));
    }

    // Show form to create a new admin
    public function create()
    {
        return view('admin.tambah-admin'); // This view will have the form for adding a new admin
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for admins by username or email
        $admins = User::where('role', 2)
                    ->where(function($q) use ($query) {
                        $q->where('username', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%');
                    })
                    ->get();

        return view('list-admin', compact('admins'));
    }


    // Store the new admin
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        return redirect()->route('list-admin')->with('success', 'Admin added successfully');
    }

    // Show edit admin form
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.edit-admin', compact('admin'));
    }

    // Update an admin
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $admin->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin->username = $request->username;
        $admin->email = $request->email;

        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('list-admin')->with('success', 'Admin updated successfully');
    }

    // Delete an admin
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('list-admin')->with('success', 'Admin deleted successfully');
    }

    public function laporan()
    {
        // Ambil data prestasi mahasiswa berdasarkan bulan dari tanggal selesai kegiatan
        $prestasiPerBulan = Prestasi::selectRaw('MONTH(tanggal_selesai) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');  // Buat key berdasarkan bulan agar mudah dipasangkan dengan bulan yang kosong

        // Daftar bulan dari Januari hingga Desember
        $bulanNama = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Gabungkan data prestasi dengan semua bulan, set ke 0 jika tidak ada data
        $prestasiData = [];
        foreach ($bulanNama as $bulan => $nama) {
            $prestasiData[] = [
                'bulan' => $nama,
                'jumlah' => isset($prestasiPerBulan[$bulan]) ? $prestasiPerBulan[$bulan]->jumlah : 0
            ];
        }

        return view('laporan', compact('prestasiData'));
    }
}
