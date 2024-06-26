<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\RoleModel;
use App\Models\TransaksiModel;
use App\Models\User;
use App\Models\WhatsappModel;
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

    // public function approve($id)
    // {
    //     $jamaah = JamaahModel::find($id);
    //     if ($jamaah) {
    //         $jamaah->verifikasi = 'approved';
    //         $jamaah->save();
    //     }
    //     return redirect()->back()->with('success', 'Jamaah approved successfully');
    // }

    // public function reject($id)
    // {
    //     $jamaah = JamaahModel::find($id);
    //     if ($jamaah) {
    //         $jamaah->verifikasi = 'rejected';
    //         $jamaah->save();
    //     }
    //     return redirect()->back()->with('success', 'Jamaah rejected successfully');
    // }

    public function verif(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $type = $request->get('type');
        $verif_act = $request->get('verif');

        if ($verif_act == 'biodata') {

            $jamaah = JamaahModel::findOrFail($id);
            $log = new WhatsappModel();

            if ($jamaah->verifikasi == $type) {
                return redirect()->back()->with('error', 'Data ini sudah di' . strtoupper($type));
            } else {
                $jamaah->verifikasi = $type;
                $jamaah->save();

                $tanggal = date('l, d F Y H:i') . ' WUB';
                $tanggalUpdate = date('d-m-y H:i T', strtotime($jamaah->update_at));
                $tanggalApp = $this->tanggalIDN($tanggal);

                $curl = curl_init();
                $message = $jamaah->pesanVerifBiodata($type, $tanggalUpdate, $tanggalApp);

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

                if (!$response) {
                    return redirect()->back()->with('error', 'Gagal mengirim pesan WhatsApp');
                }
            }
        } elseif ($verif_act == 'transaksi') {
            $transaksi = TransaksiModel::findOrFail($id);
            $jamaah = new JamaahModel();
            $log = new WhatsappModel();

            if ($transaksi->verifikasi == $type) {
                return redirect()->back()->with('error', 'Data ini sudah di' . strtoupper($type));
            } else {
                $transaksi->verifikasi = $type;
                $transaksi->save();

                $tanggal = date('l, d F Y H:i') . ' WIB';
                $tanggalUpdate = date('d-m-Y H:i T', strtotime($transaksi->updated_at));
                $tanggalApp = $this->tanggalIDN($tanggal);

                // area whatsapp
                $curl = curl_init();
                $message = $transaksi->pesanVerifTransaksi($type, $tanggalUpdate, $tanggalApp, $id);
                $Q_transaksi = DB::table('t_transaksi as a')
                    ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
                    ->join('t_layanan as c', 'a.id_layanan', '=', 'c.id_layanan')
                    ->select('a.*', 'c.*', 'b.no_hp')
                    ->where('a.id_transaksi', '=', $id)
                    ->first();
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
                        'target' => $Q_transaksi->no_hp,
                        'message' => "$message",
                        'countryCode' => '62'
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ZQFA!45KMw+YfkBK-CJj'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                if (!$response) {
                    return redirect()->back()->with('error', 'Gagal mengirim pesan WhatsApp.');
                }
            }
        }

        $log->ip = $request->ip();
        $log->json = json_encode(['target' => $jamaah->no_hp, 'message' => $message, 'response' => $response]);
        $log->status = $response ? 'success' : 'failed';
        $log->action = 'Whatsapp Verifikasi ' . strtoupper($verif_act);
        $log->save();

        return redirect()->back()->with('success', 'Data Verifikasi ' . strtoupper($verif_act) . ' Berhasil Di ' . strtoupper($type) . '.');
    }

    private function tanggalIDN($date)
    {
        $hariIDN = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];
        $bulanIDN = [
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

        return strtr($date, array_merge($hariIDN, $bulanIDN));
    }
}
