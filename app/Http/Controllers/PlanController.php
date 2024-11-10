<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getAllPlans()
    {
        $plans = Plan::all();
        return response()->json([
            'data' => [
                'plans' => $plans
            ]
        ]);
    }

    
}
