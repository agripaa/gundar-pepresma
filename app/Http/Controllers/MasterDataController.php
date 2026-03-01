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
        return view('tambah-master-data', $this->getMasterData());
    }

    public function manage()
    {
        return view('tambah-master-data', $this->getMasterData());
    }

    public function kepesertaan()
    {
        return view('master-data.kepesertaan', [
            'kepesertaan' => KepesertaanData::all(),
        ]);
    }

    public function kategori()
    {
        return view('master-data.kategori', [
            'kategori' => KategoriData::all(),
        ]);
    }

    public function prestasi()
    {
        return view('master-data.prestasi', [
            'prestasi' => PrestasiData::all(),
        ]);
    }

    public function capaianJuara()
    {
        return view('master-data.capaian-juara', [
            'capaianJuara' => CapaianJuara::all(),
        ]);
    }

    public function posisi()
    {
        return view('master-data.posisi', [
            'posisi' => PosisiData::all(),
        ]);
    }

    protected function getMasterData(): array
    {
        return [
            'kepesertaan' => KepesertaanData::all(),
            'kategori' => KategoriData::all(),
            'prestasi' => PrestasiData::all(),
            'capaianJuara' => CapaianJuara::all(),
            'posisi' => PosisiData::all(),
        ];
    }
}
