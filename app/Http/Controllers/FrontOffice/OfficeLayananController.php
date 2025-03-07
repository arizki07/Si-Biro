<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeLayananController extends Controller
{
    public function index()
    {
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();
        return view('pages.front-office.office-layanan.index', [
            'act' => 'LayananO',
            'title' => 'Data Layanan Office',
            'layanan' => $layanan,
            'jamaah' => $jamaah
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_layanan' => 'required|string',
                'kuota' => 'required|string',
                'tahun_pemberangkatan' => 'required|string',
                'bulan_pemberangkatan' => 'required|string',
                'paket' => 'required|string',
                'status_paket' => 'required|string',
                'deskripsi' => 'required|string',
                'foto_bg' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            if ($request->hasFile('foto_bg')) {
                $foto_bg = $request->file('foto_bg');
                $filefotoBg = uniqid() . '_' . date('y-m-d') . '.' . $foto_bg->getClientOriginalExtension();
                $pathfotoBg = 'layanan/foto-bg/' . $filefotoBg;
                Storage::disk('public')->put($pathfotoBg, file_get_contents($foto_bg));
            }

            LayananModel::create([
                'judul_layanan' => $request->judul_layanan,
                'kuota' => $request->kuota,
                'tahun_pemberangkatan' => $request->tahun_pemberangkatan,
                'bulan_pemberangkatan' => $request->bulan_pemberangkatan,
                'paket' => $request->paket,
                'status_paket' => $request->status_paket,
                'deskripsi' => $request->deskripsi,
                'foto_bg' => $filefotoBg ?? null,
            ]);
            return redirect()->route('office.index')->with('success', 'Layanan added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add layanan: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_layanan' => 'required|string',
            'kuota' => 'required|numeric',
            'bulan_pemberangkatan' => 'required|string',
            'paket' => 'required|string',
            'status_paket' => 'required|string',
            'deskripsi' => 'required|string',
            'foto_bg' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $layanan = LayananModel::findOrFail($id);

        $layanan->judul_layanan = $request->judul_layanan;
        $layanan->kuota = $request->kuota;
        $layanan->bulan_pemberangkatan = $request->bulan_pemberangkatan;
        $layanan->paket = $request->paket;
        $layanan->status_paket = $request->status_paket;
        $layanan->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto_bg')) {
            $foto = $request->file('foto_bg');
            $filenameLayanan = uniqid() . '_' . date('y-m-d') . '.' . $foto->getClientOriginalExtension();
            $pathLayanan = 'layanan/foto-bg/' . $filenameLayanan;
            Storage::disk('public')->put($pathLayanan, file_get_contents($foto));

            // Hapus foto lama jika ada dan simpan foto baru
            if ($layanan->foto_bg) {
                Storage::disk('public')->delete('layanan/foto-bg/' . $layanan->foto_bg);
            }

            $layanan->foto_bg = $filenameLayanan;
        }

        $layanan->save();

        return redirect()->route('office.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = LayananModel::findOrFail($id);

        // Delete related records in t_jadwal table
        $layanan->jadwals()->delete();

        if (!empty($layanan->foto_bg)) {
            if (file_exists(public_path('layanan/foto-bg/') . '/' . $layanan->foto_bg)) {
                unlink(public_path('layanan/foto-bg/') . '/' . $layanan->foto_bg);
            }
        }

        // Delete record in t_layanan table
        $layanan->delete();

        return redirect()->route('office.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
