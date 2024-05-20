<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class KBTransaksiController extends Controller
{
    public function index()
    {
        $data = TransaksiModel::with('jamaah', 'layanan')->get();
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();;

        return view('pages.kbih.kbih-transaksi.index', [
            'title' => 'Data Transaksi KBIH',
            'act' => 'KBTrans',
            'data' => $data,
            'layanans' => $layanan,
            'jamaahs' => $jamaah
        ]);
    }
}
