<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service as ResourcesService;
use App\Http\Resources\ServiceCollection;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllServices()
    {
        $services = Service::latest()
            ->with(['serviceCategory', 'user'])
            ->get();

        $services = ServiceCollection::make($services);

        return response()->json([
            'data' => [
                'services' => $services
            ]
        ]);
    }

    public function create(Request $request)
    {

        $userPlan=auth()->user()->plan;

        if(!$userPlan){
            return response()->json([
                'message'=>'Please subscribe to a plan to add services'
            ],422);
        }

        if($userPlan->max_services<=auth()->user()->services->count()){
            return response()->json([
                'message'=>'You have reached the limit of services you can add with your current plan'
            ],422);
        }

        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'hourly_rate' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $service=Service::create([
            'user_id' => auth()->id(),
            'service_category_id' => $request->service_category_id,
            'title' => $request->title,
            'description' => $request->description,
            'hourly_rate' => $request->hourly_rate,
            'image_path' => $request->file('image')->store('services')
        ]);


        $service=ResourcesService::make($service);

        return response()->json([
            'message' => 'Service added successfully',
            'data' => [
                'service' => $service
            ]
        ], 200);
    }

    public function update(Request $request)
    {

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'hourly_rate' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        $service = Service::find($request->service_id);

        $service->update([
            'service_category_id' => $request->service_category_id,
            'title' => $request->title,
            'description' => $request->description,
            'hourly_rate' => $request->hourly_rate,
        ]);

        if ($request->hasFile('image')) {
            $service->update([
                'image_path' => $request->file('image')->store('services')
            ]);
        }

        return response()->json([
            'message' => 'Service updated successfully'
        ], 200);
    }

    public function delete(Request $request){
        $request->validate([
            'service_id' => 'required|exists:services,id'
        ]);

        $service=Service::find($request->service_id);

        $service->delete();

        return response()->json([
            'message'=>'Service deleted successfully'
        ],200);
    }
}
