<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;
use App\Models\ReportModel;
use App\Models\LayananModel;
use App\Models\JamaahModel;
use App\Models\WhatsappModel;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportModel = new ReportModel();
        $Qreport = $reportModel->QueryReport();
        return view('pages.admin.data-report.index', [
            'title' => 'Data Report',
            'act' => 'report',
            'report' => $Qreport
        ]);
    }

    public function destroy ($id)
    {
        $report = ReportModel::findOrFail($id);

        // if ($report->file_opsional) {
        //     Storage::delete('report/' . $report->file_opsional);
        // }

        $report->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function view($id)
    {
        $report = ReportModel::findOrFail($id);
        $keterangan = json_decode($report->keterangan, true);
        
        $reportModel = new ReportModel();
        $QreportByID = $reportModel->QueryReportByID($id);

        if (!$QreportByID) {
            return redirect()->back()->with('error', 'Data gagal dibuka. Cek apakah sudah melakukan transaksi?');
        }
        // dd($QreportByID);

        // MCU
        $mcu = ReportModel::where('id_jamaah', $QreportByID->id_jamaah)
        ->where('tipe_report', 'MCU')
        ->orderBy('tahap', 'DESC')
        ->get();

        $keteranganMCU = $mcu->groupBy('tahap')
        ->map(function ($items) {
            return $items->sortBy('tahap')->map(function ($item) {
                return json_decode($item->keterangan, true);
            });
        });


        // BIMBINGAN
        $bimbingan = ReportModel::where('id_jamaah', $QreportByID->id_jamaah)
        ->where('tipe_report', 'BIMBINGAN')
        ->orderBy('tahap', 'DESC')
        ->get();

        $keteranganBimbingan = $bimbingan->groupBy('tahap')
        ->map(function ($items) {
            return $items->sortBy('tahap')->map(function ($item) {
                return json_decode($item->keterangan, true);
            });
        });
        
        // PASSPORT
        $passport = ReportModel::where('id_jamaah', $QreportByID->id_jamaah)
        ->where('tipe_report', 'PASSPORT')
        ->orderBy('tahap', 'DESC')
        ->get();

        $keteranganPassport = $passport->groupBy('tahap')
        ->map(function ($items) {
            return $items->sortBy('tahap')->map(function ($item) {
                return json_decode($item->keterangan, true);
            });
        });

        // MANASIK
        $manasik = ReportModel::where('id_jamaah', $QreportByID->id_jamaah)
        ->where('tipe_report', 'MANASIK')
        ->orderBy('tahap', 'DESC')
        ->get();

        $keteranganManasik = $manasik->groupBy('tahap')
        ->map(function ($items) {
            return $items->sortBy('tahap')->map(function ($item) {
                return json_decode($item->keterangan, true);
            });
        });
        // dd($keterangans);

        $whatsapp = WhatsappModel::where('id_jamaah', $QreportByID->nomor_jamaah)->get();
        return view('pages.admin.data-report.view', [
            'title' => 'Detail Report',
            'act' => 'report',
            'report' => $report,
            'qr' => $QreportByID,
            'wa' => $whatsapp,
            // 'keterangan' => $keterangan,
            'mcu' => $keteranganMCU,
            'bimbingan' => $keteranganBimbingan,
            'passport' => $keteranganPassport,
            'manasik' => $keteranganManasik,
        ]);
    }
}
