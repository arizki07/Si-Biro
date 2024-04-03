<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HeaderImport;
use DateTime;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $act = $request->get('type');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $now = new DateTime();
        $formatted_datetime = $now->format('dmYHis');
        $type = $request->input('type');

        if ($type === 'add') {
            if ($act === 'upload_jadwal') {
                $file_name = 'Jadwal_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/jadwal';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-jadwal')->with('error', $e->getMessage());
                }
            } elseif ($act == 'upload_layanan') {
                $file_name = 'SPJ_' . $formatted_datetime . '.xlsx';
                $destination_folder = 'doc/layanan';

                $this->create_folder($destination_folder);

                try {
                    Excel::import(new HeaderImport(), $request->file('file'), $destination_folder . '/' . $file_name);
                } catch (\Exception $e) {
                    return redirect()->to('data-jadwal')->with('error', $e->getMessage());
                }
            }
        } else if ($type === 'update') {
            if ($act === 'upload_jadwal' || $act == 'upload_layanan') {
                // $file_name = 'SPJ_' . $formatted_datetime . '.xlsx';
                // $destination_folder = 'arsip/spj';

                // $this->create_folder($destination_folder);

                // try {
                //     Excel::import(new ImportUpdate(), $request->file('file'), $destination_folder . '/' . $file_name);
                // } catch (\Exception $e) {
                return redirect()->to('data-jadwal')->with('error', 'Pengembangan');
            }
            // }
        } else {
            return redirect()->to('data-jadwal')->with('error', 'Anda belum memilih tipe proses Add/Update.');
        }

        return redirect()->to('data-jadwal')->with('success', 'Data berhasil diimport.');
    }

    private function create_folder($folder_path)
    {
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
    }
}
