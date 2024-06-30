<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\GrupModel;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\RoleModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JamaahController extends Controller
{
    public function index()
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
        $jamaah = JamaahModel::where('id_user', Auth::id())->get();
        $roles = RoleModel::all();
        $layanans = LayananModel::all();
        return view('pages.jamaah.biodata-jamaah.index', [
            'act' => 'Jamaah',
            'judul' => 'Data Jamaah',
            'jamaah' => $jamaah,
            'roles' => $roles,
            'layanans' => $layanans,
            'biodataStatus' => $biodataStatus,
            'json_bank' => json_decode(file_get_contents(public_path('json/bank.json')), true),
            'json_provinsi' => json_decode(file_get_contents(public_path('json/provinsi.json')), true),
            'json_kecamatan' => json_decode(file_get_contents(public_path('json/kecamatan.json')), true),
            'json_kota' => json_decode(file_get_contents(public_path('json/kota.json')), true),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'umur' => 'required|string|max:20',
            'jk' => 'required|string|max:10',
            'status' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15|min:11',
            'no_hp_wali' => 'nullable|string|max:15|min:11',
            'no_rekening' => 'required|string|max:30',
            'no_ktp' => 'required|string|max:16|min:16',
            'no_kk' => 'required|string|max:17|min:16',
            'bank' => 'required|string',
            'berat_badan' => 'required|string|max:20',
            'tinggi_badan' => 'required|string|max:20',
            'warna_kulit' => 'required|string|max:30',
            'pekerjaan' => 'required|string|max:100',
            'pendidikan' => 'required|string|max:20',
            'pernah_haji_umroh' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kota_kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'warga_negara' => 'required|string|max:100',
            'gol_darah' => 'required|string|max:100',
            'foto_ktp' => 'required|mimes:png,jpg,jpeg|max:2048',
            'foto_kk' => 'required|mimes:png,jpg,jpeg|max:2048',
            'pas_foto' => 'required|mimes:png,jpg,jpeg|max:2048',
            'foto_passport' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'kode_grup' => 'required|string|max:20',
        ]);

        // Simpan foto KTP
        $filenameKtp = $this->storeFile($request->file('foto_ktp'), 'biodata/foto-ktp');
        // Simpan foto KK
        $filenameKk = $this->storeFile($request->file('foto_kk'), 'biodata/foto-kk');
        // Simpan foto Passport (jika ada)
        $filenamePassport = $request->hasFile('foto_passport') ? $this->storeFile($request->file('foto_passport'), 'biodata/foto-passport') : null;
        // Simpan pas foto
        $filenamePasFoto = $this->storeFile($request->file('pas_foto'), 'biodata/pas-foto');

        $layanan = LayananModel::findOrFail($request->input('id_layanan'));

        // Periksa apakah kuota tersedia
        if ($layanan->kuota > 0) {
            $layanan->kuota -= 1;
            $layanan->save();

            // Simpan data JamaahModel
            $jamaah = JamaahModel::create([
                'id_user' => Auth::id(),
                'id_role' => Auth::user()->role->id_role,
                'id_layanan' => $request->input('id_layanan'),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'umur' => $request->input('umur'),
                'jk' => $request->input('jk'),
                'status' => $request->input('status'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'no_hp' => $request->input('no_hp'),
                'no_hp_wali' => $request->input('no_hp_wali'),
                'no_rekening' => $request->input('no_rekening'),
                'no_ktp' => $request->input('no_ktp'),
                'no_kk' => $request->input('no_kk'),
                'no_passport' => $request->input('no_passport'),
                'bank' => $request->input('bank'),
                'berat_badan' => $request->input('berat_badan'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'warna_kulit' => $request->input('warna_kulit'),
                'pekerjaan' => $request->input('pekerjaan'),
                'pendidikan' => $request->input('pendidikan'),
                'pernah_haji_umroh' => $request->input('pernah_haji_umroh'),
                'kelurahan' => $request->input('kelurahan'),
                'kecamatan' => $request->input('kecamatan'),
                'kota_kabupaten' => $request->input('kota_kabupaten'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'alamat_lengkap' => $request->input('alamat_lengkap'),
                'warga_negara' => $request->input('warga_negara'),
                'gol_darah' => $request->input('gol_darah'),
                'foto_ktp' => $filenameKtp,
                'foto_kk' => $filenameKk,
                'foto_passport' => $filenamePassport,
                'pas_foto' => $filenamePasFoto,
            ]);
            $jamaah->save();

            // Simpan data GrupModel terkait
            $grup = GrupModel::create([
                'id_jamaah' => $jamaah->id_jamaah,
                'kode_grup' => $request->input('kode_grup'),
                'no_hp' => $jamaah->no_hp,
            ]);
            $grup->save();

            // Redirect atau tindakan lain setelah berhasil menyimpan
            return redirect()->back()->with('success', 'Data jamaah telah berhasil ditambahkan dan kuota layanan berkurang.');
        } else {
            return redirect()->back()->with('error', 'Kuota layanan tidak tersedia.');
        }
    }

    /**
     * Simpan file ke storage dan kembalikan nama file yang disimpan
     */
    private function storeFile($file, $path)
    {
        $filename = uniqid() . '_' . date('y-m-d') . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($path, $file, $filename);
        return $filename;
    }
}
