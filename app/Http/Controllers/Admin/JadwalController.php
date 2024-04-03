<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\uraianJadwalModel;

class JadwalController extends Controller
{
    public function index()
    {
        return view('pages.admin.data-jadwal.index', [
            'title' => 'Data Jadwal',
            'act' => 'jadwal',
            'jadwal' => JadwalModel::all(),
            'URJadwal' => UraianJadwalModel::all()
        ]);
    }
}
