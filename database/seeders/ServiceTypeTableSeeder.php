<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_type = [
            '24Hr Patrol', 
            'CCTV', 
            'Fencing', 
            'Security Lighting', 
            'Secure Barrier', 
            'Patroled',
            'Disability Freindly',
            'BPA Member',
            'Drop Keys'
        ];
        
        foreach ($service_type as $value) {
            DB::table('service_types')->insert([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
