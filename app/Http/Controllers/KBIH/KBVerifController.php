<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class KBVerifController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        $layanan = LayananModel::all();
        return view('pages.kbih.kbih-verifikasi.index', [
            'title' => 'Data Verifikasi',
            'act' => 'KBverif',
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
            'layanan' => $layanan
        ]);
    }
}
