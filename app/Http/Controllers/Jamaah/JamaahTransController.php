<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JamaahTransController extends Controller
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

        $userId = Auth::id();

        // Fetch transactions based on id_jamaah
        $data = [];
        if ($userJamaah) {
            $data = TransaksiModel::with('jamaah', 'layanan')
                ->where('id_jamaah', $userJamaah->id_jamaah)
                ->get();
        }

        $layanan = LayananModel::all();
        $jamaah = JamaahModel::where('id_user', $userId)->get();

        $isBiodataFilled = JamaahModel::where('id_user', $userId)->exists();
        $isTransactionFilled = TransaksiModel::where('id_jamaah', $userJamaah->id_jamaah)->exists();

        return view('pages.jamaah.transaksi-jamaah.index', [
            'title' => 'Data Transaksi Jamaah',
            'act' => 'TransJamaah',
            'data' => $data,
            'layanans' => $layanan,
            'jamaahs' => $jamaah,
            'isBiodataFilled' => $isBiodataFilled,
            'isTransactionFilled' => $isTransactionFilled,
            'biodataStatus' => $biodataStatus,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_jamaah' => 'required', // ID Jamaah tidak perlu divalidasi secara eksplisit karena diambil dari form
            'id_layanan' => 'required',
            'tipe_pembayaran' => 'required',
            'jumlah_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required',
            'foto_bukti_pembayaran' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
        ]);

        // Simpan file bukti pembayaran ke storage
        $fotoBukti = $request->file('foto_bukti_pembayaran');
        $filename = uniqid() . '_' . date('y-m-d') . '.' . $fotoBukti->getClientOriginalExtension();
        $path = 'transaksi/foto-bukti/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($fotoBukti));

        // Persiapkan data untuk disimpan ke database
        $transaksiData = [
            'id_jamaah' => $request->input('id_jamaah'),
            'id_layanan' => $request->input('id_layanan'),
            'tipe_pembayaran' => $request->input('tipe_pembayaran'),
            'jumlah_pembayaran' => $request->input('jumlah_pembayaran'),
            'tanggal_pembayaran' => $request->input('tanggal_pembayaran'),
            'foto_bukti_pembayaran' => $filename,
            'status_pembayaran' => 'Berhasil',
        ];

        // Simpan data transaksi ke database menggunakan model TransaksiModel
        $transaksi = TransaksiModel::create($transaksiData);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data Transaksi Berhasil Disimpan!');
    }
}
