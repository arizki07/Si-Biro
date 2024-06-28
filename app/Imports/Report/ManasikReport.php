<?php

namespace App\Imports\Report;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ReportModel;
use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\JadwalModel;
use App\Models\UraianJadwalModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
// use Carbon\Carbon;

class ManasikReport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        // echo "Masuk Sini"; die;
        if (!array_key_exists('nomor_jamaah', $row)) {
            Log::error("nomor_jamaah tidak boleh kosong: " . json_encode($row));
            throw ValidationException::withMessages(['nomor_jamaah' => 'Jamaah tidak ditemukan dalam data.']);
        }

        $id_jamaah = $row['nomor_jamaah'];

        $jamaah = JamaahModel::find($id_jamaah);
        if (!$jamaah) {
            throw ValidationException::withMessages(['nomor_jamaah' => 'Jamaah tidak ditemukan.']);
        }

        $id_layanan = $jamaah->id_layanan;
        if (!$id_layanan) {
            throw ValidationException::withMessages(['id_layanan' => 'Jamaah tersebut belum memilih layanan.']);
        }

        // $jadwal = JadwalModel::where('id_layanan', $id_layanan)->first();
        $jadwal = JadwalModel::where('id_layanan', $id_layanan)->where('tipe_jadwal', 'MANASIK')->first();
        if (!$jadwal) {
            throw ValidationException::withMessages(['id_jadwal' => 'Jadwal tidak ditemukan untuk layanan yang dipilih.']);
        }
        $id_jadwal = $jadwal->id_jadwal;

        $URjadwal = UraianJadwalModel::where('nomor_jadwal', $jadwal->nomor_jadwal)
        ->where('tahap', $row['tahap'])
        ->first();
        if (!$URjadwal) {
            throw ValidationException::withMessages(['id_uraian_jadwal' => 'Uraian jadwal tidak ditemukan untuk jadwal yang dipilih.']);
        }
        $id_URjadwal = $URjadwal->id_uraian_jadwal;

        // Debugging to check values
        Log::info("id_jamaah: $id_jamaah, id_layanan: $id_layanan, id_jadwal: $id_jadwal, id_URjadwal: $id_URjadwal");

        $keterangan = [];

        foreach ($row as $key => $value) {
            if (!in_array($key, ['nomor_jamaah', 'status_report', 'tahap']) && !is_null($value)) {
                $keterangan[$key] = $value;
            }
        }

        $keteranganJson = json_encode($keterangan);

        return new ReportModel([
            'id_layanan' => $id_layanan,
            'id_jadwal' => $id_jadwal,
            'id_uraian_jadwal' => $id_URjadwal,
            'id_jamaah' => $row['nomor_jamaah'],
            'tahap' => $row['tahap'],
            'tipe_report' => 'MANASIK',
            'status_report' => $row['status_report'],
            'keterangan' => $keteranganJson,
        ]);
        // dd($model);
        // $model->save();
    }

     /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}

