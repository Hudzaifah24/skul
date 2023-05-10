<?php

namespace Database\Seeders;

use App\Models\Clas;
use App\Models\Learning;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Learning::truncate();

        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) {
            Learning::create([
               'name' => $faker->randomElement(['Ips','Ipa','Agama','B.Indonesia','Olahraga','Mtk']),
               'order' => $faker->randomDigit(),
               'hour_from' => $faker->randomElement(['07:30','08:30','09:30','10:00','11:00','12:00']),
               'hour_to' => $faker->randomElement(['07:30','08:30','09:30','10:00','11:00','12:00']),
               'day' => $faker->randomElement([1,2,3,4,5,6,7]),
               'class_id' => rand(1, Clas::count()),
               'user_id' => rand(1, User::where('role','teacher')->count()),
            ]);
        }

        for ($i=0; $i < 7; $i++) {
            Learning::create([
                'name' => $faker->randomElement(['Ips','Ipa','Agama','B.Indonesia','Olahraga','Mtk']),
                'order' => $faker->randomDigit(),
                'hour_from' => $faker->randomElement(['07:30','08:30','09:30','10:00','11:00','12:00']),
                'hour_to' => $faker->randomElement(['07:30','08:30','09:30','10:00','11:00','12:00']),
                'day' => $faker->randomElement([1,2,3,4,5,6,7]),
                'class_id' => 21,
                'user_id' => rand(1, User::where('role','teacher')->count()),
            ]);
        }
    }
}
