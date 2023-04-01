<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BrandPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands_price')->truncate();    
        $days_array = '[{"day_1": "10.25"}, {"day_2": "11.25"}, {"day_3": "13.24"},{"day_4": "16.24"},{"day_5": "19.24"},{"day_6": "21.24"},{"day_7": "22.24"},
        {"day_8": "25.24"},{"day_9": "27.24"},{"day_10": "29.24"},{"day_11": "31.24"},{"day_12": "33.24"},{"day_13": "36.24"},{"day_14": "40.24"},
        {"day_15": "44.24"},{"day_16": "48.24"},{"day_17": "52.24"},{"day_18": "56.24"},{"day_19": "60.24"},{"day_20": "63.24"},{"day_21": "66.24"},
        {"day_22": "69.24"},{"day_23": "72.24"},{"day_24": "75.24"},{"day_25": "78.24"},{"day_26": "82.24"},{"day_27": "85.24"},{"day_28": "89.24"},
        {"day_29": "92.24"},{"day_30": "96.24"},{"day_31": "5"}]';
        foreach(range('A', 'Z') as $char) {
            DB::table('brands_price')->insert([
                'brand' => $char,
                'status' => 0,
                'days_price' => $days_array
            ]);
        }                        
    }
}
