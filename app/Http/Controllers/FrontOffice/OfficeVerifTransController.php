<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class OfficeVerifTransController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.front-office.office-trans.index', [
            'act' => 'Officetrans',
            'judul' => 'Front Office Transaksi',
            'transaksi' => $transaksi,
            'jamaah' => $jamaah,
            'layanan' => $layanan,
        ]);
    }

    public function approve($id)
    {
        $transaksi = TransaksiModel::find($id);
        if ($transaksi) {
            $transaksi->verifikasi = 'approved';
            $transaksi->save();
        }
        return redirect()->back()->with('success', 'Jamaah approved successfully');
    }

    public function reject($id)
    {
        $transaksi = TransaksiModel::find($id);
        if ($transaksi) {
            $transaksi->verifikasi = 'rejected';
            $transaksi->save();
        }
        return redirect()->back()->with('success', 'Jamaah rejected successfully');
    }
}
