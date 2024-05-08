<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    public function index()
    {
        $jamaah = JamaahModel::all();
        $roles = RoleModel::all();
        $layanans = LayananModel::all();
        return view('pages.admin.data-biodata.index', [
            'jamaah' => $jamaah,
            'roles' => $roles,
            'layanans' => $layanans,
            'title' => 'Biodata',
            'act' => 'biodata',
            'json_bank' => json_decode(file_get_contents(public_path('json/bank.json')), true),
            'json_provinsi' => json_decode(file_get_contents(public_path('json/provinsi.json')), true),
            'json_kecamatan' => json_decode(file_get_contents(public_path('json/kecamatan.json')), true),
            // 'json_kelurahan' => json_decode(file_get_contents(public_path('json/kelurahan.json')), true),
            'json_kota' => json_decode(file_get_contents(public_path('json/kota.json')), true),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $request->file('foto_ktp');
            $filenameKtp = uniqid() . '_' . date('y-m-d') . '.' . $foto_ktp->getClientOriginalExtension();
            $pathKtp = 'biodata/foto-ktp/' . $filenameKtp;
            Storage::disk('public')->put($pathKtp, file_get_contents($foto_ktp));
        }

        if ($request->hasFile('foto_kk')) {
            $foto_kk = $request->file('foto_kk');
            $filenameKk = uniqid() . '_' . date('y-m-d') . '.' . $foto_kk->getClientOriginalExtension();
            $pathKk = 'biodata/foto-kk/' . $filenameKk;
            Storage::disk('public')->put($pathKk, file_get_contents($foto_kk));
        }

        if ($request->hasFile('foto_passport')) {
            $foto_passport = $request->file('foto_passport');
            $filenamePassport = uniqid() . '_' . date('y-m-d') . '.' . $foto_passport->getClientOriginalExtension();
            $pathPassport = 'biodata/foto-passport/' . $filenamePassport;
            Storage::disk('public')->put($pathPassport, file_get_contents($foto_passport));
        }

        if ($request->hasFile('pas_foto')) {
            $pas_foto = $request->file('pas_foto');
            $filenamePasFoto = uniqid() . '_' . date('y-m-d') . '.' . $pas_foto->getClientOriginalExtension();
            $pathPasFoto = 'biodata/pas-foto/' . $filenamePasFoto;
            Storage::disk('public')->put($pathPasFoto, file_get_contents($pas_foto));
        }

        $user = Auth::user();

        // var_dump($user);
        if ($user) {
            $jamaah = new JamaahModel();
            $jamaah->id_user = $user->id_user;
            $jamaah->id_role = $user->role->id_role;
            $jamaah->id_layanan = $request->input('id_layanan');
            $jamaah->nama_lengkap = $request->input('nama_lengkap');
            $jamaah->umur = $request->input('umur');
            $jamaah->jk = $request->input('jk');
            $jamaah->status = $request->input('status');
            $jamaah->tempat_lahir = $request->input('tempat_lahir');
            $jamaah->tgl_lahir = $request->input('tgl_lahir');
            $jamaah->no_hp = $request->input('no_hp');
            $jamaah->no_hp_wali = $request->input('no_hp_wali');
            $jamaah->no_rekening = $request->input('no_rekening');
            $jamaah->no_ktp = $request->input('no_ktp');
            $jamaah->no_kk = $request->input('no_kk');
            $jamaah->no_passport = $request->input('no_passport');
            $jamaah->bank = $request->input('bank');
            $jamaah->berat_badan = $request->input('berat_badan');
            $jamaah->tinggi_badan = $request->input('tinggi_badan');
            $jamaah->warna_kulit = $request->input('warna_kulit');
            $jamaah->pekerjaan = $request->input('pekerjaan');
            $jamaah->pendidikan = $request->input('pendidikan');
            $jamaah->pernah_haji_umroh = $request->input('pernah_haji_umroh');
            $jamaah->kelurahan = $request->input('kelurahan');
            $jamaah->kecamatan = $request->input('kecamatan');
            $jamaah->kota_kabupaten = $request->input('kota_kabupaten');
            $jamaah->provinsi = $request->input('provinsi');
            $jamaah->kode_pos = $request->input('kode_pos');
            $jamaah->alamat_lengkap = $request->input('alamat_lengkap');
            $jamaah->warga_negara = $request->input('warga_negara');
            $jamaah->gol_darah = $request->input('gol_darah');
            $jamaah->foto_ktp = $filenameKtp ?? null;
            $jamaah->foto_kk = $filenameKk ?? null;
            $jamaah->foto_passport = $filenamePassport ?? null;
            $jamaah->pas_foto = $filenamePasFoto ?? null;

            // var_dump($jamaah);
            // dd($jamaah);
            $jamaah->save();
        }
        return redirect()->back()->with('success', 'Data jamaah telah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'id_role' => 'required',
            'id_layanan' => 'required',
            'nama_lengkap' => 'required|string',
            'umur' => 'required|numeric',
            'jk' => 'required|string',
            'status' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|string',
            'no_hp_wali' => 'required|string',
            'no_rekening' => 'required|string',
            'no_ktp' => 'required|string',
            'no_kk' => 'required|string',
            'bank' => 'required|string',
            'berat_badan' => 'required|string',
            'tinggi_badan' => 'required|string',
            'warna_kulit' => 'required|string',
            'pekerjaan' => 'required|string',
            'pendidikan' => 'required|string',
            'pernah_haji_umroh' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'warga_negara' => 'required|string',
            'gol_darah' => 'required|string',
            'foto_ktp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_passport' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pas_foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil data biodata berdasarkan ID
        $biodata = JamaahModel::findOrFail($id);

        // Update data dengan nilai yang diterima dari form
        $biodata->id_role = $request->id_role;
        $biodata->id_layanan = $request->id_layanan;
        $biodata->nama_lengkap = $request->nama_lengkap;
        $biodata->umur = $request->umur;
        $biodata->jk = $request->jk;
        $biodata->status = $request->status;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tgl_lahir = $request->tgl_lahir;
        $biodata->no_hp = $request->no_hp;
        $biodata->no_hp_wali = $request->no_hp_wali;
        $biodata->no_rekening = $request->no_rekening;
        $biodata->no_ktp = $request->no_ktp;
        $biodata->no_kk = $request->no_kk;
        $biodata->bank = $request->bank;
        $biodata->berat_badan = $request->berat_badan;
        $biodata->tinggi_badan = $request->tinggi_badan;
        $biodata->warna_kulit = $request->warna_kulit;
        $biodata->pekerjaan = $request->pekerjaan;
        $biodata->pendidikan = $request->pendidikan;
        $biodata->pernah_haji_umroh = $request->pernah_haji_umroh;
        $biodata->kelurahan = $request->kelurahan;
        $biodata->kecamatan = $request->kecamatan;
        $biodata->kota_kabupaten = $request->kota_kabupaten;
        $biodata->provinsi = $request->provinsi;
        $biodata->kode_pos = $request->kode_pos;
        $biodata->alamat_lengkap = $request->alamat_lengkap;
        $biodata->warga_negara = $request->warga_negara;
        $biodata->gol_darah = $request->gol_darah;

        // Cek apakah ada file foto yang diunggah dan update foto jika ada
        if ($request->hasFile('foto_ktp')) {
            $fotoKTP = $request->file('foto_ktp');
            $namaFotoKTP = time() . '.' . $fotoKTP->getClientOriginalExtension();
            $fotoKTP->move(public_path('biodata/foto-ktp/'), $namaFotoKTP);
            $biodata->foto_ktp = $namaFotoKTP;
        }

        if ($request->hasFile('foto_kk')) {
            $fotoKK = $request->file('foto_kk');
            $namaFotoKK = time() . '.' . $fotoKK->getClientOriginalExtension();
            $fotoKK->move(public_path('biodata/foto-kk/'), $namaFotoKK);
            $biodata->foto_kk = $namaFotoKK;
        }

        if ($request->hasFile('foto_passport')) {
            $fotoPassport = $request->file('foto_passport');
            $namaFotoPassport = time() . '.' . $fotoPassport->getClientOriginalExtension();
            $fotoPassport->move(public_path('biodata/foto-passport/'), $namaFotoPassport);
            $biodata->foto_passport = $namaFotoPassport;
        }

        if ($request->hasFile('pas_foto')) {
            $pasFoto = $request->file('pas_foto');
            $namaPasFoto = time() . '.' . $pasFoto->getClientOriginalExtension();
            $pasFoto->move(public_path('biodata/pas-foto/'), $namaPasFoto);
            $biodata->pas_foto = $namaPasFoto;
        }

        $biodata->save();

        return redirect()->route('data.biodata')->with('success', 'Biodata berhasil diperbarui.');
    }

    public function delete($id)
    {

        // Temukan data biodata berdasarkan ID
        $jamaah = JamaahModel::findOrFail($id);

        // Hapus foto-foto terkait jika ada
        if ($jamaah->foto_ktp) {
            // Hapus foto KTP dari direktori
            if (file_exists(public_path('path_ke_folder_foto_ktp') . '/' . $jamaah->foto_ktp)) {
                unlink(public_path('path_ke_folder_foto_ktp') . '/' . $jamaah->foto_ktp);
            }
        }

        if ($jamaah->foto_kk) {
            // Hapus foto KK dari direktori
            if (file_exists(public_path('path_ke_folder_foto_kk') . '/' . $jamaah->foto_kk)) {
                unlink(public_path('path_ke_folder_foto_kk') . '/' . $jamaah->foto_kk);
            }
        }

        if ($jamaah->foto_passport) {
            // Hapus foto Passport dari direktori
            if (file_exists(public_path('path_ke_folder_foto_passport') . '/' . $jamaah->foto_passport)) {
                unlink(public_path('path_ke_folder_foto_passport') . '/' . $jamaah->foto_passport);
            }
        }

        if ($jamaah->pas_foto) {
            // Hapus pas foto dari direktori
            if (file_exists(public_path('path_ke_folder_pas_foto') . '/' . $jamaah->pas_foto)) {
                unlink(public_path('path_ke_folder_pas_foto') . '/' . $jamaah->pas_foto);
            }
        }

        // Hapus data jamaah
        $jamaah->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('data.biodata')->with('success', 'Biodata berhasil dihapus.');
    }
}
