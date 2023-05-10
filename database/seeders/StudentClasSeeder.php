<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Seeder;

class StudentClasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentClass::truncate();

        $i = 1;
        $a = 1;

        foreach (range(1, 10) as $index) {
            StudentClass::create([
                'student_id' => $i++,
                'class_id' => $a++,
                'period_id' => rand(1, 3),
            ]);
        }

        StudentClass::create([
            'student_id' => 21,
            'class_id' => 1,
            'period_id' => 3,
        ]);
    }
}
