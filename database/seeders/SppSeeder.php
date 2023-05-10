<?php

namespace Database\Seeders;

use App\Models\Clas;
use App\Models\SPP;
use App\Models\User;
use Illuminate\Database\Seeder;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SPP::truncate();

        SPP::create([
            'amount' => '100000',
            'deadline' => date('Y-m-d'),
            'month' => date('m'),
            'period' => '2021/2021',
            'class_id' => rand(1, Clas::count()),
            'user_id' => rand(1, User::count()),
        ]);
        SPP::create([
            'amount' => '110000',
            'deadline' => date('Y-m-d'),
            'month' => date('m'),
            'period' => '2022/2023',
            'class_id' => rand(1, Clas::count()),
            'user_id' => rand(1, User::count()),
        ]);
        SPP::create([
            'amount' => '110000',
            'deadline' => date('Y-m-d'),
            'month' => date('m'),
            'period' => '2023/2024',
            'class_id' => rand(1, Clas::count()),
            'user_id' => rand(1, User::count()),
        ]);
        SPP::create([
            'amount' => '120000',
            'deadline' => date('Y-m-d'),
            'month' => date('m'),
            'period' => '2024/2025',
            'class_id' => rand(1, Clas::count()),
            'user_id' => rand(1, User::count()),
        ]);
        SPP::create([
            'amount' => '130000',
            'deadline' => date('Y-m-d'),
            'month' => date('m'),
            'period' => '2025/2026',
            'class_id' => 1,
            'user_id' => rand(1, User::count()),
        ]);
        SPP::create([
            'amount' => '500000',
            'deadline' => date('Y-m-d'),
            'month' => 3,
            'period' => '2026/2027',
            'class_id' => 1,
            'user_id' => rand(1, User::count()),
        ]);
    }
}
