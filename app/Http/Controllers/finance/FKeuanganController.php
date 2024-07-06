<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\Transaksi;
use App\Models\TransaksiModel;
use Illuminate\Database\QueryException;

class FKeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::all();
        $jamaahs = JamaahModel::all();
        $transaksi = TransaksiModel::all();

        $periode = collect($keuangan)
            ->map(function ($item) {
                return explode('-', $item->periode)[0];
            })->unique();

        return view('pages.finance.finance-keuangan.index', [
            'keuangan' => $keuangan,
            'jamaahs' => $jamaahs,
            'transaksi' => $transaksi,
            'periode' => $periode,
            'title' => 'Data Finance Keuangan',
            'act' => 'FKeuangan',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_jamaah' => 'required|exists:t_jamaah,id_jamaah',
                'id_transaksi' => 'required|exists:t_transaksi,id_transaksi',
                'pembayaran' => 'required|string',
                'tipe_keuangan' => 'required|string|in:DP,CICILAN,PELUNASAN',
            ]);

            Keuangan::create($validatedData);

            return redirect()->back()->with('success', 'Data Keuangan telah berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data Keuangan. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'id_jamaah' => 'required|exists:t_jamaah,id_jamaah',
                'id_transaksi' => 'required|exists:t_transaksi,id_transaksi',
                'pembayaran' => 'required|string',
                'tipe_keuangan' => 'required|string|in:CICILAN,PELUNASAN',
            ]);

            $keuangan = Keuangan::findOrFail($id);
            $keuangan->update($validatedData);

            return redirect()->back()->with('success', 'Data keuangan berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data keuangan. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            $keuangan = Keuangan::findOrFail($id);
            $keuangan->delete();
            return redirect()->back()->with('success', 'Data keuangan berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data keuangan. Silakan coba lagi.');
        }
    }
}
