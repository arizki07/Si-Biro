<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class OfficeTransakController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.front-office.office-transaksi.index', [
            'act' => 'OfficeTr',
            'judul' => 'Data Transaksi Office',
            'jamaah' => $jamaah,
            'layanan' => $layanan,
            'transaksi' => $transaksi
        ]);
    }
}
