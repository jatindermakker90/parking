<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer_type = ['Recommended', 'Park Mark', 'Featured', 'Guarantee', 'Special Offer', 'Buy with Confidence'];
        
        foreach ($offer_type as $value) {
            DB::table('offer_types')->insert([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
