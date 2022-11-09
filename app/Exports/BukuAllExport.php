<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class BukuAllExport implements FromCollection, WithMapping, WithHeadings, WithStyles, WithColumnWidths
{
    protected $data;
    private $row = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        $ca = date('d-m-Y', strtotime($data->created_at));
        return [
            ++$this->row,
            $data->name,
            $data->gender,
            $data->hp,
            $data->agency,
            $data->necessary,
            $ca,
        ];
    }

    public function headings(): array
    {
        return [
            [
                'BUKU TAMU',
            ],
            [' '],
            [
                'No',
                'Nama',
                'P/L',
                'HP',
                'Instansi',
                'Keterangan',
                'Update',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:G3')->getFont()->setBold(true);
        $sheet->mergeCells('A1:G1');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 5,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
        ];
    }
}
