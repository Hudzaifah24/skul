<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bill::truncate();

        Bill::create([
            'name' => 'Liburan Ke Jogja Bay',
            'sum' => '500000',
            'deadline' => date('Y-m-d')
        ]);
        Bill::create([
            'name' => 'Rihlah Ke Lor Sambi',
            'sum' => '100000',
            'deadline' => date('Y-m-d')
        ]);
        Bill::create([
            'name' => 'Liburan Ke Malioboro',
            'sum' => '300000',
            'deadline' => date('Y-m-d')
        ]);
        Bill::create([
            'name' => 'Liburan Ke Pantai',
            'sum' => '200000',
            'deadline' => date('Y-m-d')
        ]);
    }
}
