<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeVerifController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $layanan = LayananModel::all();
        $roles = RoleModel::all();
        return view('pages.front-office.office-verif.index', [
            'judul' => 'Data Front Office Verifikasi',
            'act' => 'OfficeVerif',
            'jamaah' => $jamaah,
            'roles' => $roles,
            'layanan' => $layanan,
        ]);
    }

    public function approve($id)
    {
        $jamaah = JamaahModel::find($id);
        if ($jamaah) {
            $jamaah->verifikasi = 'approved';
            $jamaah->save();
        }
        return redirect()->back()->with('success', 'Jamaah approved successfully');
    }

    public function reject($id)
    {
        $jamaah = JamaahModel::find($id);
        if ($jamaah) {
            $jamaah->verifikasi = 'rejected';
            $jamaah->save();
        }
        return redirect()->back()->with('success', 'Jamaah rejected successfully');
    }
}
