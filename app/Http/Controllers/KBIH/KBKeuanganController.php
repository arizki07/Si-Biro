<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class KBKeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::all();
        $jamaahs = JamaahModel::all();
        $transaksi = TransaksiModel::all();

        $periode = collect($keuangan)->map(function ($item) {
            return explode('-', $item->periode)[0];
        })->unique();

        return view('pages.kbih.kbih-keuangan.index', [
            'keuangan' => $keuangan,
            'jamaahs' => $jamaahs,
            'transaksi' => $transaksi,
            'periode' => $periode,
            'title' => 'Data Keuangan KBIH',
            'act' => 'KBKeuangan',
        ]);
    }
}
