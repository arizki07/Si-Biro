<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Jadwal\Add\HeaderImport;
use App\Imports\Report\HeaderReport;
use App\Imports\Jadwal\Update\HeaderUpdateImport;
use DateTime;

class ImportController extends Controller
{
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
