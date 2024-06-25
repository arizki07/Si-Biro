<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;
use App\Models\ReportModel;
use App\Models\LayananModel;
use App\Models\JamaahModel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->get('action');
        $bios = ReportModel::join('t_jamaah', 't_report.id_jamaah', '=', 't_jamaah.id_jamaah')
                ->select('t_report.*', 't_jamaah.*') 
                ->get();
                // dd($bios);

        if ($action == 'mcu') {
            $data = [
                'title' => 'Report Hasil MCU',
                'act' => 'report-mcu',
                'report' => ReportModel::where('tipe_report', 'MCU')->get(),
                'biodata' => $bios
            ];
        } elseif ($action == 'passport') {
            $data = [
                'title' => 'Report Hasil Passport',
                'act' => 'report-passport',
                'report' => ReportModel::where('tipe_report', 'PASSPORT')->get(),
                'biodata' => $bios
            ];
        } elseif ($action == 'bimbingan') {
            $data = [
                'title' => 'Report Hasil Bimbingan',
                'act' => 'report-bimbingan',
                'report' => ReportModel::where('tipe_report', 'BIMBINGAN')->get(),
                'biodata' => $bios
            ];
        } else {
            $data = [
                'title' => 'Report Hasil MCU',
                'act' => 'report-mcu',
                'report' => ReportModel::where('tipe_report', 'MCU')->get(),
                'biodata' => $bios
            ];
        }

        return view('pages.admin.data-report.index', $data, [
            'urJadwal' => UraianJadwalModel::all(),
            'jadwal' => JadwalModel::all(),
            'biodata' => JamaahModel::all(),
            'layanan' => LayananModel::all()
        ]);
    }
}

// <?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\JamaahModel;
// use App\Models\Keuangan;
// use App\Models\LayananModel;
// use App\Models\TransaksiModel;
// use Illuminate\Http\Request;

// class ReportController extends Controller
// {
//     public function index()
//     {
//         $jamaah = JamaahModel::all();
//         $layanan = LayananModel::all();
//         return view('pages.admin.report.index', [
//             'act' => 'Report',
//             'judul' => 'Data Report Keuangan',
//             'jamaah' => $jamaah,
//             'layanan' => $layanan,
//         ]);
//     }

//     public function view()
//     {
//         $jamaah = JamaahModel::all();
//         $keuangan = Keuangan::all();
//         $transaksi = TransaksiModel::all();
//         return view('pages.admin.report.view', [
//             'act' => 'Report',
//             'judul' => 'Data Report',
//             'jamaah' => $jamaah,
//             'keuangan' => $keuangan,
//             'transaksi' => $transaksi,
//         ]);
//     }
// }
