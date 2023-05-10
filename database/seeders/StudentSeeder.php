<?php

namespace Database\Seeders;

use App\Models\Student;
use DateTime;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::truncate();

        $f = Factory::create('id_ID');

        for ($i=0; $i < 20; $i++) {
            Student::create([
                'nisn' => $f->randomNumber(),
                'nik' => $f->nik(),
                'name' => $f->firstName(),
                'gender' => $f->randomElement(['Laki-Laki', 'Perempuan']),
                'born' => $f->dateTimeThisYear(),
                'place_of_birth' =>$f->city(),
                'religion' => $f->randomElement(['Islam','Kristen','Hinddu','Buddha','Prostestan','Konghocu']),
                'address' => $f->address(),
                'memorization_juz' =>$f->randomDigit(),
                'memorization_page' =>$f->randomDigit(),
                'email_verified_at' => now(),
                'password' => Hash::make(1234),
                'remember_token' => Str::random(10),

            ]);
        }

        Student::create([
            'nisn' => 123456789,
            'nik' => 1234567891011123,
            'name' => 'Murid',
            'gender' => $f->randomElement(['Laki-Laki', 'Perempuan']),
            'born' => new DateTime('2004-10-24'),
            'place_of_birth' =>$f->city(),
            'religion' => $f->randomElement(['Islam','Kristen','Hinddu','Buddha','Prostestan','Konghocu']),
            'address' => $f->address(),
            'memorization_juz' => 1,
            'memorization_page' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make(1234),
            'remember_token' => Str::random(10),
        ]);
    }
}
