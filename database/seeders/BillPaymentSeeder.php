<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BillPayment;
use Illuminate\Database\Seeder;
class BillPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillPayment::truncate();

        foreach(range(0, 2) as $index){
            BillPayment::create([
                'bill_id' => 1,
                'status' => 'lunas',
                'amount' => '500000',
                'bank_id' => rand(1, Bank::count()),
                'student_id' => 21,
                'proof' => 'bukti.jpg',
            ]);
        }
    }
}
