<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    Cart\CartController, 
    Product\ProductController, 
    Product\Product_CategoryController, 
    Product\Product_ImgController, 
    Vendor\VendorController,
    User\CustomerController
};

// use App\Http\Controllers\Cart\CartController;
// use App\Http\Controllers\Product\{ProductController, Product_ImgController};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Endpoint for Cart
Route::apiResource('cart', CartController::class);

//Endpoint for Product
Route::apiResource('product', ProductController::class);

//Endpoint for Product_Category
Route::apiResource('product_category', Product_CategoryController::class);

//Endpoint for Product_Img
Route::apiResource('product_img', Product_ImgController::class);

//Endpoint for Vendor
Route::apiResource('vendors', VendorController::class);

//Endpoint for Customer
Route::apiResource('users', CustomerController::class);


