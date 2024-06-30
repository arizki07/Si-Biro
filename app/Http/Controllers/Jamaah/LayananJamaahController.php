<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananJamaahController extends Controller
{
    public function index()
    {
        $userJamaah = JamaahModel::where('id_user', Auth::id())->first();
        $biodataStatus = 'kosong'; // Default status

        if ($userJamaah) {
            $biodataStatus = $userJamaah->verifikasi;
        }
        $layanan = LayananModel::all();
        return view('pages.jamaah.layanan-jamaah.index', [
            'act' => 'JamaahLayanan',
            'judul' => 'Data Layanan Jamaah',
            'layanan' => $layanan,
            'biodataStatus' => $biodataStatus,
        ]);
    }
}
