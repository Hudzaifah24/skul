<?php

namespace Database\Seeders;

use App\Models\Fossil;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class FossilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fossil::truncate();
        $f = Factory::create('id_ID');

        Fossil::create([
            'name' => 'Budi man sari',
            'income' => $f->randomNumber(),
            'work' => $f->jobTitle(),
            'phone_number' => $f->phoneNumber(),
            'religion' => $f->randomElement(['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu', 'Katolik']),
            'education' => $f->randomElement(['SD','SMP','SMA','S1','S2','S3']),
            'status' => 'Ayah',
            'student_id' => 21,
        ]);

        Fossil::create([
            'name' => $f->name(),
            'income' => $f->randomNumber(),
            'work' => $f->jobTitle(),
            'phone_number' => $f->phoneNumber(),
            'religion' => $f->randomElement(['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu', 'Katolik']),
            'education' => $f->randomElement(['SD','SMP','SMA','S1','S2','S3']),
            'status' => 'Ibu',
            'student_id' => 21,
        ]);
    }
}
