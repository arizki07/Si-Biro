<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        return view('pages.admin.report.index', [
            'act' => 'Report',
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
        return view('pages.admin.report.view', [
            'act' => 'Report',
            'judul' => 'Data Report',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi,
        ]);
    }
}
