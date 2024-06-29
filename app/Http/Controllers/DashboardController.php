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
        $biodataStatus = 'kosong'; // Default status

        if ($userJamaah) {
            $biodataStatus = $userJamaah->verifikasi;
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
