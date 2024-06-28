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
        $userId = Auth::id();

        $data = TransaksiModel::with('jamaah', 'layanan')->get();
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();

        // Cek apakah biodata telah diisi
        $isBiodataFilled = JamaahModel::where('id_jamaah', $userId)->exists();

        // Cek apakah transaksi telah diisi
        $isTransactionFilled = TransaksiModel::where('id_jamaah', $userId)->exists();

        return view('pages.jamaah.transaksi-jamaah.index', [
            'title' => 'Data Transaksi Jamaah',
            'act' => 'TransJamaah',
            'data' => $data,
            'layanans' => $layanan,
            'jamaahs' => $jamaah,
            'isBiodataFilled' => $isBiodataFilled,
            'isTransactionFilled' => $isTransactionFilled,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jamaah' => 'required',
            'id_layanan' => 'required',
            'tipe_pembayaran' => 'required',
            'jumlah_pembayaran' => 'required',
            // 'status_pembayaran' => 'required',
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
        // dd($validator);
        try {

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
            }

            $fotoBukti = $request->file('foto_bukti_pembayaran');
            $filename = uniqid() . '_' . date('y-m-d') . '.' . $fotoBukti->getClientOriginalExtension();
            $path = 'transaksi/foto-bukti/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($fotoBukti));

            $validatedData = $validator->validated();
            $validatedData['foto_bukti_pembayaran'] = $filename ?? null;
            $validatedData['status_pembayaran'] = 'Berhasil';

            // dd($validatedData);
            $transId = TransaksiModel::insertGetId($validatedData);

            $this->generatePdf($transId, $validatedData);
            return redirect()->back()->with('success', 'Data Transaksi Berhasil Disimpan!');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
            }

            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }
}
