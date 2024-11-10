<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'=>'FREE PLAN',
            'description'=>'You can have 5 services and 5 store products',
            'price'=>0,
            'duration_in_days'=>30,
            'max_services'=>5,
            'max_store_products'=>5
        ]);

        Plan::create([
            'name'=>'PREMIUM PLAN',
            'description'=>'You can have 20 services and 20 store products',
            'price'=>10,
            'duration_in_days'=>30,
            'max_services'=>20,
            'max_store_products'=>20
        ]);

        Plan::create([
            'name'=>'BUSINESS PLAN',
            'description'=>'You can have 50 services and 50 store products',
            'price'=>20,
            'duration_in_days'=>30,
            'max_services'=>50,
            'max_store_products'=>50
        ]);

        Plan::create([
            'name'=>'ENTERPRISE PLAN',
            'description'=>'You can have unlimited services and store products',
            'price'=>50,
            'duration_in_days'=>30,
            'max_services'=>50000,
            'max_store_products'=>50000
        ]);


    }
}
