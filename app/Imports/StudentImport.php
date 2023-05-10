<?php

namespace App\Imports;

use App\Models\Clas;
use App\Models\Fossil;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithStartRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            '1' => ['required','unique:students,nisn','max:10','min:10'],
            '2' => ['required','unique:students,nik','max:16','min:16'],
            '3' => ['required'],
            '4' => ['required'],
            '5' => ['required'],
            '6' => ['required'],
            '7' => ['required','in:P,L'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'NISN wajib diisi',
            '1.unique' => 'NISN sudah dimiliki',
            '1.max' => 'NISN tidak boleh lebih dari 10 angka',
            '1.min' => 'NISN tidak boleh kurang dari 10 angka',
            '2.required' => 'NIK wajib diisi',
            '2.unique' => 'NIK sudah dimiliki',
            '2.max' => 'NIK tidak boleh lebih dari 16 angka',
            '2.min' => 'NIK tidak boleh kurang dari 16 angka',
            '3.required' => 'Nama wajib diisi',
            '4.required' => 'Tempat lahir wajib diisi',
            '5.required' => 'Tanggal lahir wajib diisi',
            '6.required' => 'Ibu kandung wajib diisi',
            '7.required' => 'Jenis kelamin wajib diisi',
            '7.in' => 'Jenis kelamin wajib diisi dengan L atau P',
        ];
    }

    public function model(array $row)
    {
        $class = Clas::where('name', $row[8])->first();

        $period = Period::orderBy('year_start', 'desc')->first();

        // Students ++
        $students = Student::create([
            'nisn' => $row[1],
            'nik' => $row[2],
            'name' => $row[3],
            'place_of_birth' => $row[4],
            'born' => $row[5],
            'gender' => $row[7] == 'L' ? 'Laki-Laki' : 'Perempuan',
            'religion' => 'Islam',
            'email_verified_at' => now(),
            'password' => Hash::make(1234),
            'remember_token' => Str::random(10),
        ]);

        // Fossil ++
        $fossil = new Fossil([
            'student_id' => $students->id,
            'name' => $row[6],
            'status' => 'Ibu',
        ]);

        // StudentClass ++
        $studentClass = new StudentClass([
            'student_id' => $students->id,
            'class_id' => $class->id,
            'period_id' => $period->id,
        ]);

        return ['students' => $students, 'fossil' => $fossil, 'studentClass' => $studentClass];
    }

    public function startRow(): int
    {
        return 2;
    }
}
