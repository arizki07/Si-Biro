<?php
// INI AREA TESTING DOANG
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function index()
    {
        return view('pages.admin.testing-wa', [
            'title' => 'Data WA',
            'act' => 'wa'
        ]);
    }

    public function testing(Request $request)
    {
        // echo "MASOK"; die;
        // dd($request);
        $curl = curl_init();  
    
    $numbers = $request->input('wa'); // Nomor WhatsApp dalam format string dipisahkan oleh koma (,)
    $numbersArray = explode(',', $numbers); // Memisahkan nomor menjadi array
    
    $message = "*TESTING*\n\n";
    $message .= "Pesan : *" . $request->input('pesan') . "*\n";
    $message .= "Pesan : Oke Berhasil Masook\n";

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
                'target' => $request->input('wa'),
                'message' => "$message",
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ZQFA!45KMw+YfkBK-CJj'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect()->back();
    }

    public function send_verifikasi(Request $request, string $id)
    {
        // echo "MASOK"; die;
        // dd($id);
        $curl = curl_init();  
        
        $message = "*TESTING*\n\n";
        $message .= "No tujuan : *" . $request->input('wa') . "*\n";
        $message .= "Pesan : *" . $request->input('pesan') . "*\n";
        $message .= "Pesan : Oke Berhasil Masook\n";

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
                'target' => $request->input('wa'),
                'message' => "$message",
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ZQFA!45KMw+YfkBK-CJj'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect()->back();
    }
}
