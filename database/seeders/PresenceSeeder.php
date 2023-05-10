<?php

namespace Database\Seeders;

use App\Models\Presence;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        foreach (range(1, 10) as $index) {
            Presence::create([
                'student_id' => $i++,
                'permission_count' => 0,
                'sick_count' => 0,
                'alpha_count' => 0,
            ]);
        }

        Presence::create([
            'student_id' => 21,
            'permission_count' => 0,
            'sick_count' => 0,
            'alpha_count' => 0,
        ]);
    }
}
