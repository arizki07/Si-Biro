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
        $userId = Auth::id();

        $isBiodataApproved = JamaahModel::where('id_user', $userId)->where('verifikasi', 'approved')->exists();

        $isTransactionApproved = TransaksiModel::whereHas('jamaah', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->where('verifikasi', 'approved')->exists();

        // Debugging
        // \Log::info('Biodata Approved: ' . ($isBiodataApproved ? 'Yes' : 'No'));
        // \Log::info('Transaction Approved: ' . ($isTransactionApproved ? 'Yes' : 'No'));

        $notification = '';
        if (!$isBiodataApproved || !$isTransactionApproved) {
            $notification = '<h4 class="text-black">Data biodata atau transaksi Anda belum disetujui Admin. Mohon tunggu proses verifikasi.</h4>';
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
            'isBiodataApproved' => $isBiodataApproved,
            'isTransactionApproved' => $isTransactionApproved,
            'notification' => $notification,
        ]);
    }
}
