<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\LayananModel;
use App\Models\RoleModel;
use App\Models\TransaksiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
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
        $role = RoleModel::count();
        $user = User::count();
        $jamaah = JamaahModel::count();
        $transaksi = TransaksiModel::count();
        $jadwal = JadwalModel::count();
        $keuangan = Keuangan::count();
        $layanan = LayananModel::count();
        $jamaahs = JamaahModel::all();
        $transaksis = TransaksiModel::all();
        return view('dashboard', [
            'act' => 'dashboard',
            'judul' => 'Halaman Utama',
            'role' => $role,
            'user' => $user,
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
            'jadwal' => $jadwal,
            'keuangan' => $keuangan,
            'layanan' => $layanan,
            'jamaahs' => $jamaahs,
            'transaksis' => $transaksis,
            'biodataStatus' => $biodataStatus,
        ]);
    }
}
