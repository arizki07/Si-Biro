<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\TransaksiModel;
use App\Models\WhatsappModel;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jamaah = JamaahModel::all();
        $transaksi = TransaksiModel::all();
        $layanan = LayananModel::all();
        return view('pages.admin.data-verifikasi.index', [
            'title' => 'Data Verifikasi',
            'act' => 'verifikasi',
            'jamaah' => $jamaah,
            'transaksi' => $transaksi,
            'layanan' => $layanan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function verif(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $jamaah = JamaahModel::findOrFail($id);
        $log = new WhatsappModel();
        $type = $request->get('type');
        $verif_act = $request->get('verif');
        if ($verif_act == 'biodata') {
            if ($jamaah->verifikasi == $type) {
                return redirect()->back()->with('error', 'Data Ini Sudah Di ' . strtoupper($type));
            } else { 
                $jamaah->verifikasi = $type;
                $jamaah->save();

                $tanggal = date('l, d F Y H:i') . ' WIB';
                $tanggalUpdate = date('d-m-Y H:i T', strtotime($jamaah->updated_at));
                $hariIndonesia = [
                    'Sunday'    => 'Minggu',
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu',
                ];
                $bulanIndonesia = [
                    'January'   => 'Januari',
                    'February'  => 'Februari',
                    'March'     => 'Maret',
                    'April'     => 'April',
                    'May'       => 'Mei',
                    'June'      => 'Juni',
                    'July'      => 'Juli',
                    'August'    => 'Agustus',
                    'September' => 'September',
                    'October'   => 'Oktober',
                    'November'  => 'November',
                    'December'  => 'Desember',
                ];

                $tanggalApp = strtr($tanggal, array_merge($hariIndonesia, $bulanIndonesia));
                // $tanggalUpdate = strtr($tanggal_update);

                // area whatsapp
                $curl = curl_init();  
                if ($type == 'approved') {
                    $message = "*Whatsapp KBIH Wadi Fatimah*\n\n";
                    $message .= "Verifikasi biodata anda sudah _*BERHASIL*_ di verifikasi pada ". $tanggalUpdate .", dengan data sebagai berikut:\n\n";
                    $message .= "Nama : *" . $jamaah->nama_lengkap . "*\n";
                    $message .= "Tgl Lahir : *" . $jamaah->tempat_lahir . ", " . date('d-m-Y', strtotime($jamaah->tgl_lahir)) . "*\n";
                    $message .= "No Ktp : *" . $jamaah->no_ktp . "*\n";
                    $message .= "Umur : *" . $jamaah->umur . " Tahun*\n";
                    $message .= "Alamat : *" . $jamaah->kecamatan . ", " . $jamaah->kota_kabupaten . ", " . $jamaah->provinsi . " " . $jamaah->kode_pos . "*\n";
                    $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
                } else {
                    $message = "*Whatsapp KBIH Wadi Fatimah*\n\n";
                    $message .= "Verifikasi biodata anda _*DITOLAK/GAGAL*_ di verifikasi pada ". $tanggalUpdate .", dengan data sebagai berikut:\n\n";
                    $message .= "Nama : *" . $jamaah->nama_lengkap . "*\n";
                    $message .= "Tgl Lahir : *" . $jamaah->tempat_lahir . ", " . date('d-m-Y', strtotime($jamaah->tgl_lahir)) . "*\n";
                    $message .= "No Ktp : *" . $jamaah->no_ktp . "*\n";
                    $message .= "Umur : *" . $jamaah->umur . " Tahun*\n";
                    $message .= "Alamat : *" . $jamaah->kecamatan . ", " . $jamaah->kota_kabupaten . ", " . $jamaah->provinsi . " " . $jamaah->kode_pos . "*\n";
                    $message .= "\nSilahkan kunjungi kantor KBIH Wadi Fatimah untuk informasi lebih lanjut.\n\n";
                    $message .= "\n_**Pesan ini dikirim secara otomatis pada $tanggalApp. Mohon tidak membalas pesan ini.*_";
                }
                // dd($message);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $jamaah->no_hp,
                        'message' => "$message",
                        'countryCode' => '62'
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ZQFA!45KMw+YfkBK-CJj'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $log->ip = $request->ip();
                $log->json = json_encode(['target' => $jamaah->no_hp, 'message' => $message, 'response' => $response]);
                $log->status = $response ? 'success' : 'failed';
                $log->action = 'Whatsapp Verifikasi';
                $log->save();

                return redirect()->back()->with('success', 'Data Verifikasi Berhasil Di Update.');
            }
        } elseif ($verif_act == 'transaksi') {
            // echo "Masuk Ke Else"; die;
            
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
