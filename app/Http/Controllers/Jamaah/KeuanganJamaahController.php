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
        // Ambil data Jamaah berdasarkan id_user yang sedang login
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

            // Ambil data keuangan berdasarkan id_jamaah dari pengguna yang sedang login
            $keuangan = Keuangan::where('id_jamaah', $userJamaah->id_jamaah)->get();
        } else {
            // Handle jika tidak ditemukan data Jamaah untuk user yang sedang login
            $keuangan = collect(); // Atau berikan array kosong jika perlu
        }

        return view('pages.jamaah.keuangan-jamaah.index', [
            'act' => 'KeuanganJam',
            'title' => 'Data Keuangan Jamaah',
            'keuangan' => $keuangan,
            'biodataStatus' => $biodataStatus,
        ]);
    }
}
