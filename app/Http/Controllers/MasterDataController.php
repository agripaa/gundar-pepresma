<?php

namespace App\Http\Controllers;

use App\Models\KepesertaanData;
use App\Models\KategoriData;
use App\Models\PrestasiData;
use App\Models\CapaianJuara;
use App\Models\PosisiData;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index()
    {
        $kepesertaan = KepesertaanData::all();
        $kategori = KategoriData::all();
        $prestasi = PrestasiData::all();
        $capaianJuara = CapaianJuara::all();
        $posisi = PosisiData::all();

        return view('list-master-data', compact('kepesertaan', 'kategori', 'prestasi', 'capaianJuara', 'posisi'));
    }

}
