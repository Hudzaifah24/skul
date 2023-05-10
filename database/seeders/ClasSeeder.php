<?php

namespace Database\Seeders;

use App\Models\Clas;
use Illuminate\Database\Seeder;

class ClasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clas::truncate();

        Clas::create([
            'name' => '1A'
        ]);
        Clas::create([
            'name' => '1B'
        ]);
        Clas::create([
            'name' => '1C'
        ]);

        Clas::create([
            'name' => '2A'
        ]);
        Clas::create([
            'name' => '2B'
        ]);
        Clas::create([
            'name' => '2C'
        ]);

        Clas::create([
            'name' => '3A'
        ]);
        Clas::create([
            'name' => '3B'
        ]);
        Clas::create([
            'name' => '3C'
        ]);

        Clas::create([
            'name' => '4A'
        ]);
        Clas::create([
            'name' => '4B'
        ]);
        Clas::create([
            'name' => '4C'
        ]);

        Clas::create([
            'name' => '5A'
        ]);
        Clas::create([
            'name' => '5B'
        ]);
        Clas::create([
            'name' => '5C'
        ]);

        Clas::create([
            'name' => '6A'
        ]);
        Clas::create([
            'name' => '6B'
        ]);
        Clas::create([
            'name' => '6C'
        ]);
    }
}
