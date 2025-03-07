<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\JadwalModel;
use App\Models\JamaahModel;
use App\Models\UraianJadwalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalJamaahController extends Controller
{
    public function index(Request $request)
    {
        $userJamaah = JamaahModel::where('id_user', Auth::id())->first();

        $biodataStatus = 'kosong';
        if ($userJamaah) {
            if ($userJamaah->verifikasi == 'approved') {
                $biodataStatus = 'approved';
            } else {
                $biodataStatus = 'pending';
            }
        }

        $action = $request->get('action');

        if ($action == 'mcu') {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'biodataStatus' => $biodataStatus,
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        } elseif ($action == 'passport') {
            $data = [
                'title' => 'Data Jadwal Passport',
                'act' => 'jadwal-passport',
                'biodataStatus' => $biodataStatus,
                'jadwal' => JadwalModel::where('tipe_jadwal', 'PASSPORT')->get()
            ];
        } elseif ($action == 'bimbingan') {
            $data = [
                'title' => 'Data Jadwal Bimbingan',
                'biodataStatus' => $biodataStatus,
                'act' => 'jadwal-bimbingan',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'BIMBINGAN')->get()
            ];
        } elseif ($action == 'manasik') {
            $data = [
                'title' => 'Data Jadwal Manasik',
                'act' => 'jadwal-manasik',
                'biodataStatus' => $biodataStatus,
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MANASIK')->get()
            ];
        } else {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'biodataStatus' => $biodataStatus,
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        }

        return view('pages.jamaah.jadwal-jamaah.index', $data, [
            'urJadwal' => UraianJadwalModel::all()
        ]);
    }
}
