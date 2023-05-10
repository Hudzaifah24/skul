<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::truncate();
        $f = Factory::create('id_ID');

        foreach(range(1,2)as $index){
            Bank::create([
                'account_number' => rand(1000000000, 9999999999),
                'name_bank' => $f->randomElement(['BSI','Mandiri','BNI','BRI','BCA']),
                'nasabah' => $f->firstName(),
                'student_id' => rand(1, Student::count()),
            ]);
        }

        Bank::create([
            'account_number' => rand(1000000000, 9999999999),
            'name_bank' => $f->randomElement(['BSI','Mandiri','BNI','BRI','BCA']),
            'nasabah' => $f->firstName(),
            'student_id' => 21,
        ]);
    }
}
