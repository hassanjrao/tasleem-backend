<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'user_id' => 1,
            'service_category_id' => 1,
            'title' => 'Web Development Service 1',
            'description' => 'Web Development Service 1 Description',
            'hourly_rate' => 25
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 1,
            'title' => 'Web Development Service 2',
            'description' => 'Web Development Service 2 Description',
            'hourly_rate' => 50
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 2,
            'title' => 'Mobile Development Service 1',
            'description' => 'Mobile Development Service 1 Description',
            'hourly_rate' => 75
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 2,
            'title' => 'Mobile Development Service 2',
            'description' => 'Mobile Development Service 2 Description',
            'hourly_rate' => 100
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 3,
            'title' => 'Desktop Development Service 1',
            'description' => 'Desktop Development Service 1 Description',
            'hourly_rate' => 125
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 3,
            'title' => 'Desktop Development Service 2',
            'description' => 'Desktop Development Service 2 Description',
            'hourly_rate' => 150
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 4,
            'title' => 'API Development Service 1',
            'description' => 'API Development Service 1 Description',
            'hourly_rate' => 175
        ]);

        Service::create([
            'user_id' => 1,
            'service_category_id' => 4,
            'title' => 'API Development Service 2',
            'description' => 'API Development Service 2 Description',
            'hourly_rate' => 200
        ]);


    }
}
