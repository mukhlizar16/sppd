<?php

namespace App\Exports;

use App\Models\Sppd;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportSppdById implements FromView, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $sppdId, $sppd;

    public function __construct($sppdId)
    {
        $this->sppdId = $sppdId;
        $this->sppd = Sppd::with('pegawais.golongan', 'SuratTugas', 'UangHarian', 'Akomodasi', 'TotalPergi', 'TotalPulang')->findOrFail($sppdId);
    }

    public function view(): View
    {
//        dd($this->sppd);
        return view('export.export-single', [
            'sppd' => $this->sppd,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1:3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false, // Set wrapText to false to prevent text wrapping
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D3D3D3'], // Warna abu-abu
            ],
        ]);

        $sheet->getStyle('1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Warna border hitam
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('2')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('3')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
