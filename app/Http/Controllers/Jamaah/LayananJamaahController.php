<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\LayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananJamaahController extends Controller
{
    public function index()
    {
        $layanan = LayananModel::all();
        return view('pages.jamaah.layanan-jamaah.index', [
            'act' => 'JamaahLayanan',
            'judul' => 'Data Layanan Jamaah',
            'layanan' => $layanan
        ]);
    }
}
