<?php

namespace App\Http\Controllers\Admin;

use App\Exports\JamaahExport;
use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\TransaksiModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ArsipController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.admin.arsip.index', [
            'act' => 'AdminArsip',
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
            'title' => 'Halaman Arsip'
        ]);
    }

    public function exportToPDF()
    {
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();

        $view = View::make('export.jamaah', [
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
        ])->render();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($view);
        $dompdf->render();

        return $dompdf->stream('Arsip Jamaah.pdf');
    }

    // public function exportToPDFId($id_jamaah)
    // {
    //     // Fetch Jamaah data for the given id_jamaah with its transaksis
    //     $jamaah = JamaahModel::with('transaksi')->findOrFail($id_jamaah);

    //     // Render the PDF view with the retrieved data
    //     $view = View::make('export.jamaah', [
    //         'jamaah' => $jamaah,
    //     ])->render();

    //     // Setup PDF rendering options
    //     $pdfOptions = new Options();
    //     $pdfOptions->set('defaultFont', 'Arial');

    //     // Initialize Dompdf
    //     $dompdf = new Dompdf($pdfOptions);
    //     $dompdf->loadHtml($view);
    //     $dompdf->render();

    //     // Return the generated PDF as a response
    //     return $dompdf->stream('Arsip Jamaah.pdf');
    // }
}
