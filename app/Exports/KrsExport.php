<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Export data KRS ke Excel.
 * Dapat digunakan untuk export KRS milik 1 mahasiswa (Mahasiswa)
 * atau seluruh data KRS (Admin), bergantung pada collection yang diberikan.
 */
class KrsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $krs;

    public function __construct($krs)
    {
        $this->krs = $krs;
    }

    public function collection()
    {
        return $this->krs;
    }

    public function headings(): array
    {
        return [
            'No',
            'NPM',
            'Nama Mahasiswa',
            'Kode Mata Kuliah',
            'Nama Mata Kuliah',
            'SKS',
            'Semester',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $row->npm,
            $row->mahasiswa->nama ?? '-',
            $row->kode_matakuliah,
            $row->matakuliah->nama_matakuliah ?? '-',
            $row->matakuliah->sks ?? 0,
            $row->semester,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
