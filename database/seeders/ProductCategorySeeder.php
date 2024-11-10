<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Electronics'
        ]);

        ProductCategory::create([
            'name' => 'Clothing'
        ]);

        ProductCategory::create([
            'name' => 'Books'
        ]);

        ProductCategory::create([
            'name' => 'Furniture'
        ]);

        ProductCategory::create([
            'name' => 'Toys'
        ]);

        ProductCategory::create([
            'name' => 'Food'
        ]);

        ProductCategory::create([
            'name' => 'Drinks'
        ]);

        // other
        ProductCategory::create([
            'name' => 'Other'
        ]);
    }
}
