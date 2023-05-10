<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::truncate();

        $faker = Faker::create('id_ID');

        $date = date('Y');

        Period::create([
            'year_start' => $date - 2,
            'year_end' => $date - 1,
            'status' => $faker->randomElement(['Active', 'Not Active']),
        ]);

        Period::create([
            'year_start' => $date - 1,
            'year_end' => $date,
            'status' => $faker->randomElement(['Active', 'Not Active']),
        ]);

        Period::create([
            'year_start' => $date,
            'year_end' => $date + 1,
            'status' => $faker->randomElement(['Active', 'Not Active']),
        ]);
    }
}
