<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganJamaahController extends Controller
{
    public function index()
    {
        $userJamaah = JamaahModel::where('id_user', Auth::id())->first();

        // Default status biodata
        $biodataStatus = 'kosong'; // Atur default sebagai kosong

        // Jika data Jamaah ditemukan, atur status berdasarkan verifikasi
        if ($userJamaah) {
            if ($userJamaah->verifikasi == 'approved') {
                $biodataStatus = 'approved'; // Jika disetujui, ubah status ke approved
            } else {
                $biodataStatus = 'pending'; // Jika belum disetujui, ubah status ke pending
            }
        }
        $keuangan = Keuangan::where('id_jamaah', Auth::id())->get();
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.jamaah.keuangan-jamaah.index', [
            'act' => 'KeuanganJam',
            'title' => 'Data Keuangan Jamaah',
            'jamaah' => $jamaah,
            'keuangan' => $keuangan,
            'transaksi' => $transaksi,
            'biodataStatus' => $biodataStatus,
        ]);
    }
}
