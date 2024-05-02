<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->get('action');

        if ($action == 'mcu') {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        } elseif ($action == 'passport') {
            $data = [
                'title' => 'Data Jadwal Passport',
                'act' => 'jadwal-passport',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'PASSPORT')->get()
            ];
        } elseif ($action == 'bimbingan') {
            $data = [
                'title' => 'Data Jadwal Bimbingan',
                'act' => 'jadwal-bimbingan',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'BIMBINGAN')->get()
            ];
        } else {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        }

        return view('pages.admin.data-jadwal.index', $data);
    }

    public function view($id)
    {
        return view('pages.admin.data-jadwal.view', [
            'jadwals' => JadwalModel::findOrFail($id),
            'URjadwals' => UraianJadwalModel::all(),
            'act' => 'layanan',
        ]);
    }
}
