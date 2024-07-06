<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\TransaksiModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class KBArsipController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        return view('pages.kbih.kbih-arsip.index', [
            'act' => 'Kbarsip',
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
            'title' => 'Halaman Arsip'
        ]);
    }

    public function exportToPDFKbih()
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
}
