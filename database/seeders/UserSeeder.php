<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $f = Factory::create('id_ID');

        foreach(range(1,10) as $index){

            User::create([
                'name' => $f->name(),
                'email' => $f->unique()->safeEmail(),
                'role' => $f->randomElement(['Teacher', 'Admin']),
                'nik' => $f->nik(),
                'position' => $f->jobTitle(),
                'phone_number' => $f->phoneNumber(),
                'gender' => $f->randomElement(['Laki-Laki', 'Perempuan']),
                'email_verified_at' => now(),
                'password' => Hash::make(1234), // password
                'remember_token' => Str::random(10),
            ]);
        }

        User::create([
            'name' => 'administrator',
            'email' => 'admin@admin',
            'role' => 'Admin',
            'gender' => 'Laki-Laki',
            'password' => Hash::make(1234),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Guntoro',
            'email' => 'teacher@teacher',
            'role' => 'Teacher',
            'nik' => $f->nik(),
            'position' => $f->jobTitle(),
            'phone_number' => $f->phoneNumber(),
            'gender' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
