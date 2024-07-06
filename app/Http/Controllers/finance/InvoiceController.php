<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiModel; // Import model Transaksi
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now()->year;

        // Mendapatkan total pendapatan untuk tahun ini
        $totalPendapatan = $this->getPendapatanPerTahun($currentYear);

        return view('pages.finance.finance-invoice.index', [
            'title' => 'Halaman invoice finance',
            'act' => 'Invoice',
            'totalPendapatan' => $totalPendapatan, // Kirim total pendapatan ke view
        ]);
    }

    public function getPendapatanPerTahun($year)
    {
        // Ambil total pendapatan dari tabel transaksi berdasarkan tahun
        $pendapatan = TransaksiModel::whereYear('tanggal_pembayaran', $year)
            ->sum('jumlah_pembayaran');

        return $pendapatan;
    }

    public function getPendapatanPeriode(Request $request)
    {
        $periode = $request->get('periode');

        // Ambil total pendapatan dari tabel transaksi berdasarkan periode
        $totalPendapatan = TransaksiModel::whereYear('tanggal_pembayaran', date('Y', strtotime($periode)))
            ->sum('jumlah_pembayaran');

        return response()->json(['totalPendapatan' => $totalPendapatan]);
    }
}
