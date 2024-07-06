<?php

namespace App\Exports;

use App\Models\JamaahModel;
use App\Models\LayananModel;
use App\Models\KeuanganModel;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportKeuanganAll implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $data = DB::table('t_keuangan as a')
            ->select('b.nama_lengkap', 'a.periode', 'b.no_ktp', 'b.no_kk', 'b.no_hp', 'd.judul_layanan', 'c.jumlah_pembayaran', 'c.tipe_pembayaran', 'c.tanggal_pembayaran')
            ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
            ->join('t_transaksi as c', 'a.id_transaksi', '=', 'c.id_transaksi')
            ->join('t_layanan as d', 'b.id_layanan', '=', 'd.id_layanan')
            ->orderBy('c.tanggal_pembayaran', 'DESC')
            ->get();

        $total_pembayaran = $data->sum('jumlah_pembayaran');

        $total_row = [
            'NAMA JAMAAH' => '',
            'PERIODE' => '',
            'NOMOR KTP' => '',
            'NOMOR KK' => '',
            'KONTAK' => '',
            'LAYANAN' => 'TOTAL',
            'JUMLAH PEMBAYARAN' => $total_pembayaran,
            'METODE PEMBAYARAN' => '',
            'TANGGAL PEMBAYARAN' => '',
        ];

        $data->push((object) $total_row);

        return $data;
    }

    public function headings(): array
    {
        return ['NAMA JAMAAH', 'PERIODE', 'NOMOR KTP', 'NOMOR KK', 'KONTAK', 'LAYANAN', 'JUMLAH PEMBAYARAN', 'METODE PEMBAYARAN', 'TANGGAL PEMBAYARAN'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('KEUANGAN ALL PERIODE');

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getColumnDimension('I')->setWidth(25);

        $sheet->getStyle('C:C')->getNumberFormat()->setFormatCode('0');
        $sheet->getStyle('D:D')->getNumberFormat()->setFormatCode('0');
        $sheet->getStyle('E:E')->getNumberFormat()->setFormatCode('0');
        $sheet->getStyle('G:G')->getNumberFormat()->setFormatCode('#,##0');

        $headerStyles = [
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'f2e1aa']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ];

        $center = [
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ];

        // $left = [
        //     'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_BOTTOM],
        // ];

        // $right = [
        //     'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_BOTTOM],
        // ];

        $sheet->getStyle('A1:I1')->applyFromArray($headerStyles);
        $sheet->getStyle('A:I')->applyFromArray($center);

        $totalStyles = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'c7f2aa']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ];

        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle('F' . ($lastRow) . ':G' . ($lastRow))->applyFromArray($totalStyles);

        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            'A1:F1' => ['alignment' => ['wrapText' => true]],
        ];
    }
}