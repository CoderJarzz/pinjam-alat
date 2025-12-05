<?php

namespace App\Exports;

use App\Models\Sewa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SewaExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles
{
    public function __construct(protected Collection $sewas)
    {
    }

    public function collection(): Collection
    {
        return $this->sewas;
    }

    public function map($sewa): array
    {
        return [
            $sewa->id,
            optional($sewa->created_at)->format('Y-m-d H:i'),
            $sewa->barang->nama ?? '-',
            $sewa->barang->merk ?? '-',
            $sewa->barang?->harga_sewa,
            $sewa->user->name ?? '-',
            $sewa->user->email ?? '-',
            $sewa->nama_penyewa,
            $sewa->alamat,
            $sewa->nomor_ktp,
            optional($sewa->tanggal_mulai)->format('Y-m-d'),
            optional($sewa->tanggal_selesai)->format('Y-m-d'),
            $sewa->total_harga,
            ucfirst($sewa->status),
            $sewa->alasan_penolakan,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Pengajuan',
            'Nama Barang',
            'Merk',
            'Harga / Hari',
            'Akun (Nama)',
            'Akun (Email)',
            'Nama di Form',
            'Alamat',
            'Nomor KTP',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Total Harga',
            'Status',
            'Alasan Penolakan',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:O1')->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFFFF'));
        $sheet->getStyle('A1:O1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1E40AF'); // indigo
        return [
            'A1:O1' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
