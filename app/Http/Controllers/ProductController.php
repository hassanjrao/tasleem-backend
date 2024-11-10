<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ResourcesProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllproducts()
    {
        $products = Product::with(['productCategory', 'user', 'productImages'])->latest()->get();

        $products=ResourcesProduct::collection($products);

        return response()->json([
            'data' => [
                'products' => $products
            ]
        ]);
    }

    public function create(Request $request){


        $userPlan=auth()->user()->plan;

        if(!$userPlan){
            return response()->json([
                'message'=>'Please subscribe to a plan to add services'
            ],422);
        }

        if($userPlan->max_store_products<=auth()->user()->products->count()){
            return response()->json([
                'message'=>'You have reached the limit of products you can add with your current plan'
            ],422);
        }


        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|image'
        ]);


        $product=Product::create([
            'user_id' => auth()->id(),
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        foreach ($request->file('images') as $image) {
            $product->productImages()->create([
                'image_path' => $image->store('products')
            ]);
        }

        return response()->json([
            'message' => 'Product added successfully',
            'data' => [
                'product' => ResourcesProduct::make($product)
            ]
        ]);

    }

    public function update(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'nullable|min:1|max:5',
            'images.*' => 'image'
        ]);

        $product=Product::find($request->product_id);

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if($request->images){
            $product->productImages()->delete();
            foreach ($request->images as $image) {
                $product->productImages()->create([
                    'image_path' => $image->store('products')
                ]);
            }
        }

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => [
                'product' => ResourcesProduct::make($product)
            ]
        ]);

    }

    public function delete(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product=Product::find($request->product_id);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
