<?php

namespace Database\Seeders;

use App\Models\Loan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loan::truncate();

        $faker = Faker::create('id_ID');

        $id = 1;

        for ($i=0; $i < 10; $i++) {
            Loan::create([
                'book' => $faker->word(),
                'author' => $faker->name(),
                'publiser' => $faker->name(),
                'loan_date' => $faker->date('Y-m-d', 'now'),
                'return_date' => $faker->date('Y-m-d', 'now'),
                'status' => $faker->randomElement(['already', 'not yet']),
                'student_id' => $id++,
            ]);
        }

        Loan::create([
            'book' => $faker->word(),
            'author' => $faker->name(),
            'publiser' => $faker->name(),
            'loan_date' => $faker->date('Y-m-d', 'now'),
            'return_date' => $faker->date('Y-m-d', 'now'),
            'status' => 'already',
            'student_id' => 21,
        ]);

        Loan::create([
            'book' => $faker->word(),
            'author' => $faker->name(),
            'publiser' => $faker->name(),
            'loan_date' => $faker->date('Y-m-d', 'now'),
            'return_date' => $faker->date('Y-m-d', 'now'),
            'status' => 'not yet',
            'student_id' => 21,
        ]);
    }
}
