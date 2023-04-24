<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

     public function run(): void
    {
        $this->call([
            AdminTableSeeder::class,
            BrandPriceTableSeeder::class,
            ServiceTypeTableSeeder::class,
            CompanyTypesTableSeeder::class,
            OfferTypeTableSeeder::class,
        ]);
    }
    // public function run()
    // {
    //     // \App\Models\User::factory(10)->create();

    // }
}
