<?php

namespace App\Http\Controllers\KBIH;

use App\Http\Controllers\Controller;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;
use Illuminate\Http\Request;

class KBJadwalController extends Controller
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
        } elseif ($action == 'manasik') {
            $data = [
                'title' => 'Data Jadwal Manasik',
                'act' => 'jadwal-manasik',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MANASIK')->get()
            ];
        } else {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        }

        return view('pages.kbih.kbih-jadwal.index', $data, [
            'urJadwal' => UraianJadwalModel::all()
        ]);
    }
}
