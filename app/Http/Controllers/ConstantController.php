<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function getConstants()
    {

        $serviceCategories = ServiceCategory::all();

        $productCategories = ProductCategory::all();

        return response()->json([
            'data' => [
                'service_categories' => $serviceCategories,
                'product_categories' => $productCategories
            ]
        ]);
    }
}
