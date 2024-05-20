<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class ReportFinanceController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        return view('pages.finance.report-keuangan.index', [
            'act' => 'RepostK',
            'judul' => 'Data Report Keuangan',
            'jamaah' => $jamaah,
            'layanan' => $layanan,
        ]);
    }

    public function view()
    {
        $jamaah = JamaahModel::all();
        $keuangan = Keuangan::all();
        $transaksi = TransaksiModel::all();
        return view('pages.finance.report-keuangan.view', [
            'act' => 'RepostK',
            'judul' => 'Data Report',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi,
        ]);
    }
}
