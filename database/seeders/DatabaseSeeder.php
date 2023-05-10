<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\BillClas;
use App\Models\BillPayment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            ClasSeeder::class,
            PeriodSeeder::class,
            LoanSeeder::class,
            FossilSeeder::class,
            GuardianSeeder::class,
            BankSeeder::class,
            StudentClasSeeder::class,
            BillSeeder::class,
            SppSeeder::class,
            LearningSeeder::class,
            MemorizationSeeder::class,
            BillPaymentSeeder::class,
            PresenceSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Category::truncate();
        Category::factory(4)->create();

        Article::truncate();
        Article::factory(4)->create();


        BillClas::truncate();
        BillClas::factory(4)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
