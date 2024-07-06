<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\Keuangan;
use App\Models\Transaksi;
use App\Models\TransaksiModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Exports\ExportKeuangan;
use App\Exports\ExportKeuanganAll;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keuangan = Keuangan::all();
        $jamaahs = JamaahModel::all();
        $transaksi = TransaksiModel::all();

        $periode = collect($keuangan)->map(function ($item) {
            return explode('-', $item->periode)[0];
        })->unique();

        return view('pages.admin.data-keuangan.index', [
            'keuangan' => $keuangan,
            'jamaahs' => $jamaahs,
            'transaksi' => $transaksi,
            'periode' => $periode,
            'title' => 'Data Keuangan',
            'act' => 'keuangan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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

    public function export (Request $request) {
        $periode_k = $request->input('periode_keuangan');
        // dd($periode_k);

        if ($periode_k == 'all') {
            return Excel::download(new ExportKeuanganAll(), 'Lap_Keuangan_All_Periode_Eks_'.date('dmy_h.i.s').'.xlsx');
        } else {
            return Excel::download(new ExportKeuangan($periode_k), 'Lap_Keuangan_Periode_' .$periode_k. '_'.date('dmy_h.i.s').'.xlsx');
        }
    }
}
