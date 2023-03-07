<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_types = ['MEET AND GREET', 'PARK AND RIDE', 'ON SITE'];
        DB::table('company_types')->truncate();
        foreach ($company_types as $value) {
            DB::table('company_types')->insert([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
