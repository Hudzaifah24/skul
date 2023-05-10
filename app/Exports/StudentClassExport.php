<?php

namespace App\Exports;

use App\Models\Fossil;
use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentClassExport implements FromCollection, WithMapping, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return StudentClass::where('class_id', $this->id)->with(['student', 'clas'])->get();
    }

    public function map($student) : array
    {
        $fossil = Fossil::where('status', 'Ibu')->where('student_id', $student->id)->first();

        return [
            $student->id,
            $student->student->nisn,
            $student->student->nik,
            $student->student->name,
            $student->student->place_of_birth,
            $student->student->born,
            $fossil == null ? 'Belum diisi' : $fossil->name,
            $student->student->gender,
            'Kelas '.$student->student->clas->first()->name,
        ];
    }

    public function headings() : array
    {
        return [
            'NO',
            'NISN',
            'NIK',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Ibu Kandung',
            'Jenis Kelamin',
            'Tingkat',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 25,
            'D' => 20,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 10,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle(1)
                    ->getAlignment()

                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A')
                    ->getAlignment()

                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('H')
                    ->getAlignment()

                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
