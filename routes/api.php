<?php

// use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('productapi', ProductController::class);
//   Route::apiResource('products', ProductController::class);
//  Route::get('/products', [ProductController::class, 'index']);
 //Route::post('/products', [ProductController::class, 'store']);
 //Route::put('/products/{product}', [ProductController::class, 'update']);

//  Route::post('/products/upload', [ProductController::class, 'upload'])->name('api.products.upload');

// Route::post('/register',[RegisteredUserController::class,'register']);

// Route::get('/user', function (Request $request){

//     return $request->user();

// })->middleware('auth:sanctum');
 Route::post('/products/upload', [ProductController::class, 'uploadImage']);

//  Route::middleware('cors')->group(function () {
//     Route::get('/endpoint', [ProductController::class, 'method']);
// });
// Route::apiResource('products', ProductController::class); //route to show product api

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
