<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class KBReportController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        return view('pages.kbih.kbih-report.index', [
            'act' => 'KBReport',
            'judul' => 'Data Report KBIH',
            'jamaah' => $jamaah,
            'layanan' => $layanan
        ]);
    }

    public function view()
    {
        $jamaah = JamaahModel::all();
        $keuangan = Keuangan::all();
        $transaksi = TransaksiModel::all();
        return view('pages.kbih.kbih-report.view', [
            'act' => 'KBReport',
            'judul' => 'Data Report KBIH',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi,
        ]);
    }
}
