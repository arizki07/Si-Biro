<?php

namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeaderImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'JADWAL' => new JadwalImport(),
            'URAIAN JADWAL' => new UraianJadwalImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}
