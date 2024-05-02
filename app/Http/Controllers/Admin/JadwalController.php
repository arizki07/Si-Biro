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

        return view('pages.admin.data-jadwal.index', $data, [
            'urJadwal' => UraianJadwalModel::all()
        ]);
    }

    public function view($id)
    {
        return view('pages.admin.data-jadwal.view', [
            'jadwals' => JadwalModel::findOrFail($id),
            'URjadwals' => UraianJadwalModel::all(),
            'act' => 'layanan',
        ]);
    }

    public function destroy($id)
    {
        try {
            $jadwal = JadwalModel::findOrFail($id);
            $uraianJadwal = UraianJadwalModel::where('nomor_jadwal', $jadwal->nomor_jadwal)->get();

            foreach ($uraianJadwal as $uraian) {
                $uraian->delete();
            }
            $jadwal->delete();
            
            return redirect()->back()->with('success', 'Data jadwal beserta uraiannya berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data jadwal. Silakan coba lagi.');
        }
    }

    public function destroyUraian($id)
    {
        try {
            $urj = UraianJadwalModel::findOrFail($id);
            $urj->delete();
            return redirect()->back()->with('success', 'Data uraian jadwal berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data uraian jadwal. Silakan coba lagi.');
        }
    }
}
