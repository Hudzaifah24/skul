<?php

namespace Database\Seeders;

use App\Models\Memorization;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class MemorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Memorization::truncate();
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) {
            Memorization::create([
               'surah' => $faker->randomElement(['Al-falaq','Al-lahab','Al-fil','Al-qadr']),
               'juz' => 30,
               'ayat_from' => $faker->randomElement(['1','2','3','4','5']),
               'ayat_to' => $faker->randomElement(['1','2','3','4','5']),
               'user_id' => rand(2,User::where('role', 'Teacher')->count()),
               'date' => $faker->dateTime(),
               'student_id' => rand(1, Student::count()),
            ]);
        }

        Memorization::create([
            'surah' => 'Al-baqarah',
            'juz' => 1,
            'ayat_from' => 1,
            'ayat_to' => 10,
            'user_id' => rand(2,User::where('role', 'Teacher')->count()),
            'date' => $faker->dateTime(),
            'student_id' => 21,
        ]);

        Memorization::create([
            'surah' => 'Al-baqarah',
            'juz' => 1,
            'ayat_from' => 11,
            'ayat_to' => 20,
            'user_id' => rand(2,User::where('role', 'Teacher')->count()),
            'date' => $faker->dateTime(),
            'student_id' => 21,
        ]);
    }
}
