<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;
use App\Models\GrupModel;
use App\Models\WhatsappModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Jadwal\Add\HeaderImport;
use DateTime;

class OfficeJadwalController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->get('action');
        $j = new JadwalModel();
        if ($action == 'mcu') {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
            // dd($data);
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
        } elseif ($action == 'manasik') {
            $data = [
                'title' => 'Data Jadwal Manasik',
                'act' => 'jadwal-manasik',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MANASIK')->get()
            ];
        } else {
            $data = [
                'title' => 'Data Jadwal MCU',
                'act' => 'jadwal-mcu',
                'jadwal' => JadwalModel::where('tipe_jadwal', 'MCU')->get()
            ];
        }

        $grup = GrupModel::select('kode_grup', \DB::raw('MIN(id_grup) as id_grup'), \DB::raw('MIN(id_jamaah) as id_jamaah'), \DB::raw('MIN(id_layanan) as id_layanan'), \DB::raw('MIN(no_hp) as no_hp'))
            ->groupBy('kode_grup')
            ->get();
      
        return view('pages.front-office.office-jadwal.index', $data, [
            'urJadwal' => UraianJadwalModel::all(),
            'grup' => $grup,
        ]);
    }

    public function view($id)
    {
        return view('pages.front-office.office-jadwal.view', [
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

    public function send_whatsapp(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $kode_grup = $request->input('kode_grup');
        $tahap = $request->input('tahap');
        $id_layanan = $request->input('id_layanan');
        $nomor_jadwal = $request->input('nomor_jadwal');
        $tipe_jadwal = $request->input('tipe_jadwal');

        if ($tahap == NULL || $kode_grup == NULL) {
            return redirect()->back()->with('error', 'Wajib memilih Grup dan Tahap.');
        }

        // echo "$kode_grup" . "$tahap";die;
        $Qgrup = DB::table('t_grup')
            ->select('no_hp')
            ->where('kode_grup', $kode_grup)
            ->where('id_layanan', $id_layanan)
            // ->get();
            ->pluck('no_hp');
        // echo "<pre>";
        // echo($Qgrup) . "<br><br><br>";
        // echo "</pre>";die;
        $wa = explode(',', $Qgrup);

        $Qjadwal = DB::table('t_uraian_jadwal')
            ->select('*')
            ->where('tahap', $tahap)
            ->where('nomor_jadwal', $nomor_jadwal)
            ->first();

        $tanggal = date('l, d F Y H:i') . ' WIB';
        $tanggalApp = $this->tanggalIDN($tanggal);

        // area whatsapp
        foreach ($Qgrup as $nomor_hp) {
            // print_r($nomor_hp); die;
            // area whatsapp
            $curl = curl_init();
            $message = "*Whatsapp KBIH Wadi Fatimah*\n\n";
            $message .= "*Assalmualaikum Warahmatullah Wabarakatuh*\n\n";
            $message .= "Informasi untuk jamaah KBIH Wadi Fatimah, Bahwasannya kami ingin mengingatkan sesuai dengan jadwal " . $tipe_jadwal . " yang sudah ada, maka akan ada jadwal yang dilaksanakan pada :\n\n";

            if ($tipe_jadwal == 'MCU') {
                $message .= "Tanggal : *" . date('d M Y', strtotime($Qjadwal->tgl_mulai_mcu)) . "*\n";
                $message .= "Pukul : *" . date('H:i', strtotime($Qjadwal->jam_mulai_mcu)) . " s/d selesai*\n";
                $message .= "Terkait : *" . $tipe_jadwal . "*\n";
                $message .= "Perihal : *" . $Qjadwal->judul_mcu . "*\n";
                $message .= "Tempat : *" . $Qjadwal->tempat_mcu . "*\n";
            } elseif ($tipe_jadwal == 'BIMBINGAN') {
                $message .= "Tanggal : *" . date('d M Y', strtotime($Qjadwal->tgl_mulai_bimbingan)) . "*\n";
                $message .= "Pukul : *" . date('H:i', strtotime($Qjadwal->jam_mulai_bimbingan)) . " s/d selesai*\n";
                $message .= "Terkait : *" . $tipe_jadwal . "*\n";
                $message .= "Perihal : *" . $Qjadwal->judul_bimbingan . "*\n";
                $message .= "Tempat : *" . $Qjadwal->tempat_bimbingan . "*\n";
            } elseif ($tipe_jadwal == 'PASSPORT') {
                $message .= "Tanggal : *" . date('d M Y', strtotime($Qjadwal->tgl_mulai_passport)) . "*\n";
                $message .= "Pukul : *" . date('H:i', strtotime($Qjadwal->jam_mulai_passport)) . " s/d selesai*\n";
                $message .= "Terkait : *" . $tipe_jadwal . "*\n";
                $message .= "Perihal : *" . $Qjadwal->judul_passport . "*\n";
                $message .= "Tempat : *" . $Qjadwal->tempat_passport . "*\n";
            } else {
                $message .= "Tanggal : *" . date('d M Y', strtotime($Qjadwal->tgl_mulai_manasik)) . "*\n";
                $message .= "Pukul : *" . date('H:i', strtotime($Qjadwal->jam_mulai_manasik)) . " s/d selesai*\n";
                $message .= "Terkait : *" . $tipe_jadwal . "*\n";
                $message .= "Perihal : *" . $Qjadwal->judul_manasik . "*\n";
                $message .= "Tempat : *" . $Qjadwal->tempat_manasik . "*\n";
            }

            $message .= "\nPerlu diketahui bahwa kegiatan ini *WAJIB* diikuti oleh semua jamaah yang sudah terdaftar. Syukron.\n\n";
            $message .= "Wassalamualaikum Warahmatullah Wabarakatuh.\n\n";

            $message .= "\n_**Harap jangan balas pesan ini! Pesan ini terkirim otomatis dari sistem pada $tanggalApp.*_";
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
                    'target' => $nomor_hp,
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
            } else {
                $wee = DB::table('t_grup')
                    ->select('*')
                    ->where('kode_grup', $kode_grup)
                    ->where('id_layanan', $id_layanan)
                    ->get();
                
                    foreach ($wee as $item) {
                        $log = new WhatsappModel();
                    
                        $log->ip = $request->ip();
                        $log->id_jamaah = $item->id_jamaah; 
                        $log->status = $response ? 'success' : 'failed';
                        $log->json = json_encode(['target' => $nomor_hp, 'message' => $message, 'response' => $response]);
                        $log->action = 'Whatsapp Jadwal '.ucwords(strtolower($tipe_jadwal)).' Tahap ' . $tahap . ' Grup ' . $item->kode_grup;
                    
                        $existingLog = WhatsappModel::where([
                            'ip' => $log->ip,
                            'id_jamaah' => $log->id_jamaah,
                            'status' => $log->status,
                            'action' => $log->action,
                        ])->exists();
                    
                        if (!$existingLog) {
                            $log->save();
                        }
                    }
            }
        }
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

    public function import(Request $request)
    {
        $act = $request->get('proses');
        $type = $request->input('type');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $ayeuna = new DateTime();
        $formatted_datetime = $ayeuna->format('dmYHis');

        if ($type == 'add') {
            if ($act == 'upload_jadwal') {
                $file_name = 'Jadwal_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/jadwal';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-jadwal')->with('error', $e->getMessage());
                }
            } elseif ($act == 'upload_layanan') {
                $file_name = 'Layanan_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/layanan';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-layanan')->with('error', $e->getMessage());
                }
            } elseif ($act == 'upload_report') {
                // echo "MASOK"; die;
                $file_name = 'Report_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/jadwal';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderReport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-report')->with('error', $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'Type tidak dikenali.');
            }
            return redirect()->back()->with('success', 'Data berhasil diimport.');
        } else if ($type == 'update') {
            if ($act == 'upload_jadwal') {
                $file_name = 'Jadwal_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/jadwal';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderUpdateImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('/')->with('error', $e->getMessage());
                }
            } elseif ($act == 'upload_layanan') {
                $file_name = 'Layanan_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/layanan';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderUpdateImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-layanan')->with('error', $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'Type tidak dikenali.');
            }
            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Anda belum memilih tipe proses Add/Update.');
        }
    }

    private function create_folder($folder_path)
    {
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
    }
}
