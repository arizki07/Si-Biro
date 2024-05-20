<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class KBBioController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $roles = RoleModel::all();
        $layanans = LayananModel::all();
        return view('pages.kbih.kbih-biodata.index', [
            'jamaah' => $jamaah,
            'roles' => $roles,
            'layanans' => $layanans,
            'title' => 'Data Biodata KBIH',
            'act' => 'KBBio',
            'json_bank' => json_decode(file_get_contents(public_path('json/bank.json')), true),
            'json_provinsi' => json_decode(file_get_contents(public_path('json/provinsi.json')), true),
            'json_kecamatan' => json_decode(file_get_contents(public_path('json/kecamatan.json')), true),
            // 'json_kelurahan' => json_decode(file_get_contents(public_path('json/kelurahan.json')), true),
            'json_kota' => json_decode(file_get_contents(public_path('json/kota.json')), true),
        ]);
    }
}
