<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class FTransaksiController extends Controller
{
    public function index()
    {
        $data = TransaksiModel::with('jamaah', 'layanan')->get();
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();;
        return view('pages.finance.finance-transaksi.index', [
            'title' => 'Data Finance Transaksi',
            'act' => 'FTransaksi',
            'data' => $data,
            'layanans' => $layanan,
            'jamaahs' => $jamaah
        ]);
    }
}
