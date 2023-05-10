<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Clas;
use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillClasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bill_id' => rand(1, Bill::count()),
            'class_id' => rand(1, Clas::count()),
            'period_id' => rand(1, Period::count()),
        ];
    }
}
