<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = TransaksiModel::with('jamaah','layanan')->get();
        $layanan = LayananModel::all();
        $jamaah = JamaahModel::all();;

        return view('pages.admin.data-transaksi.index', [
            'title' => 'Data Transaksi',
            'act' => 'transaksi',
            'data' => $data,
            'layanans' => $layanan,
            'jamaahs' => $jamaah
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
            $validatedData['jumlah_pembayaran'] = preg_replace('/[^\d]/', '', $validatedData['jumlah_pembayaran']);

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

    public function update(Request $request, $id)
    {
        $transaksi = TransaksiModel::find($id);

        if (!$transaksi) {
            return redirect('/data-transaksi')->with('error', 'Data transaksi tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'id_jamaah' => 'required',
            'id_layanan' => 'required',
            'tipe_pembayaran' => 'required',
            'jumlah_pembayaran' => 'required',
            // 'status_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required',
            // 'foto_bukti_pembayaran' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
        ]);

        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // $fotoBukti = $request->file('foto_bukti_pembayaran');
            // $filename = uniqid() . '_' . date('y-m-d') . '.' . $fotoBukti->getClientOriginalExtension();
            // $path = 'transaksi/foto-bukti/' . $filename;
            // Storage::disk('public')->put($path, file_get_contents($fotoBukti));


            if ($request->hasFile('foto_bukti_pembayaran')) {
                if ($transaksi->foto_bukti_pembayaran) {
                    Storage::delete('transaksi/foto-bukti/' . $transaksi->foto_bukti_pembayaran);
                }

                $fotoBukti = $request->file('foto_bukti_pembayaran');
                $filename = uniqid() . '_' . date('y-m-d') . '.' . $fotoBukti->getClientOriginalExtension();
                $path = 'transaksi/foto-bukti/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($fotoBukti));

                $validatedData = $validator->validated();
                $validatedData['foto_bukti_pembayaran'] = $filename;

                $transaksi->update($validatedData);
            } else {
                $validatedData = $validator->validated();
                // Hapus 'foto' dari data jika tidak diberikan
                unset($validatedData['foto_bukti_pembayaran']);

                $transaksi->update($validatedData);
            }

            return redirect()->back()->with('success', 'Data Transaksi Berhasil Diperbarui!');
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

    public function destroy ($id)
    {
        $trans = TransaksiModel::findOrFail($id);

        if ($trans->foto_bukti_pembayaran) {
            Storage::delete('transaksi/foto-bukti/' . $trans->foto_bukti_pembayaran);
        }

        $trans->delete();;

        // return redirect()->back()->with('success', 'Data Budaya Berhasil Dihapus!');
        return redirect()->back()->with('success', 'Data Transaksi Berhasil Dihapus!');
    }

    public function generatePdf($transId, $data)
    {
        // dd($transId, $data);
        $transIdString = strval($transId);

        $pdf = Pdf::setOptions([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif',
        ])
        ->loadView('pages.admin.data-transaksi.cetak-trans', [
            'data' => $data,
        ])
        ->setPaper('a4', 'landscape');

        $directoryPath = public_path('arsip/transaksi/pdf/');
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true); // Buat direktori dengan izin 0755
        }

        $filePath = $directoryPath . $transIdString . '.pdf';

        $pdf->save($filePath);

        return response()->json(['message' => 'PDF telah disimpan', 'filePath' => $filePath]);

    }
}
