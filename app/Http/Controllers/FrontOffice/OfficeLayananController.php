<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;

class OfficeLayananController extends Controller
{
    public function index()
    {
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();
        return view('pages.front-office.office-layanan.index', [
            'act' => 'LayananO',
            'layanan' => $layanan,
            'jamaah' => $jamaah
        ]);
    }
}
