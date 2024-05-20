<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JadwalModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;

class KBLayananController extends Controller
{
    public function index()
    {
        $layanan = LayananModel::all();
        $jadwal = JadwalModel::all();
        return view('pages.kbih.kbih-layanan.index', [
            'act' => 'KBLayanan',
            'title' => 'Data Layanan KBIH',
            'layanan' => $layanan,
            'jadwal' => $jadwal
        ]);
    }
}
