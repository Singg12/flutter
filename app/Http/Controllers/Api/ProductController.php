<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        // if($products->count() > 0){
        //     return ProductResource::collection($products);
        // }
        // else {
        // return response()->json(['message' => 'No Product available'],200);
        // }

        // $products = Product::all();
        // return response()->json([
        //     // 'status' => true,
        //  return $products
        // ]);

        $products = Product::get();
       
        if ($products->count() > 0) {
            // Return a collection of products using the ProductResource
            return $products->map(function ($product) {
                return new ProductResource($product);
            });
        } else {
            // Return a 404 response if no products are found
            return response()->json(['message' => 'No products found'], 404);
        }
    }


    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:png,jpg,webp'

        ]);

        if($validator->fails()){
            return response()->json([
                'message' =>'All field are empty',
                'error' =>$validator->messages(),
            ]);
        }

        $path ='uploads/product/';
        $file = null;

        if($request->has('image')){
            $file = $request -> file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path($path), $filename);

        }
        // $product = Product::create($validator);

       $product = Product::create([
        'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename ? $path.$filename : null,
         ]);
        return response()->json(['message' => 'Product created','data'=> new ProductResource($product)], 200);
    }


    public function uploadImage(Request $request)
    {
        $path = 'uploads/product/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path($path), $filename);
            return $path . $filename;
        }
        return null;
    
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
        // return response()->json(['message' => 'Product ' . $product]); test message
    }

    public function update(Request $request,Product $product)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image_path' => 'nullable|string'

        ]);
        if($validator->fails()){
            return response()->json([
                'message' =>'All field are empty',
                'error' =>$validator->messages(),
            ]);
        }

       $product ->update([
        'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return response()->json(['message' => 'Product updatated','data'=> new ProductResource($product)], 200);
    }
    //     return response()->json(['message' => 'Product ' . $id . ' updated']);
     //}

    public function destroy(Product $id)
    {
        $id -> delete();
        return response()->json([
            'message' => 'Product Deleted Sucess',
        ],200);
    }
}
