<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class OfficeReportController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        return view('pages.front-office.report-office.index', [
            'act' => 'OfficeRe',
            'judul' => 'Data Report Office',
            'jamaah' => $jamaah,
            'layanan' => $layanan
        ]);
    }

    public function view()
    {
        $jamaah = JamaahModel::all();
        $keuangan = Keuangan::all();
        $transaksi = TransaksiModel::all();
        return view('pages.front-office.report-office.view', [
            'act' => 'OfficeRe',
            'judul' => 'Data Report Office',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi,
        ]);
    }
}
