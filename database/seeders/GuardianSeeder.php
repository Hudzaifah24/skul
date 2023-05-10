<?php

namespace Database\Seeders;

use App\Models\Guardian;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Database\Seeder;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guardian::truncate();
        $f = Factory::create('id_ID');

        foreach(range(1,5) as $index){
            Guardian::create([
                'name' => $f->name(),
                'relationship' => $f->randomElement(['Ayah','Ibu','Paman','Bibi','Kakek','Nenek','Kakak']),
                'religion' => $f->randomElement(['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu', 'Katolik']),
                'work' => $f->jobTitle(),
                'phone_number' => $f->phoneNumber(),
                'education' => $f->randomElement(['SD','SMP','SMA','S1','S2','S3']),
                'student_id' => rand(1, Student::count()),
            ]);
        }

        Guardian::create([
            'name' => 'Budi man sari',
            'relationship' => 'Ayah',
            'religion' => $f->randomElement(['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu', 'Katolik']),
            'work' => $f->jobTitle(),
            'phone_number' => $f->phoneNumber(),
            'education' => $f->randomElement(['SD','SMP','SMA','S1','S2','S3']),
            'student_id' => 21,
        ]);
    }
}
