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
        $reportModel = new ReportModel();
        $Qreport = $reportModel->QueryReport();
        return view('pages.admin.data-report.index', [
            'title' => 'Data Report',
            'act' => 'report',
            'report' => $Qreport
        ]);
    }
}
