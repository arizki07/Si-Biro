<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class KeuanganJamaahController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::all();
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.jamaah.keuangan-jamaah.index', [
            'act' => 'KeuanganJam',
            'title' => 'Data Keuangan Jamaah',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi
        ]);
    }
}
