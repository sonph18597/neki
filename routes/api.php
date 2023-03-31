<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\ShoesController;
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
//Shoes
Route::get('Shoes', [ShoesController::class, 'index']);
Route::post('Shoes', [ShoesController::class, 'create']);
Route::get('Shoes/{id}', [ShoesController::class, 'show']);
Route::put('Shoes/{id}', [ShoesController::class, 'update']);
Route::delete('Shoes/{id}', [ShoesController::class, 'delete']);
Route::get('Shoes/search', [ShoesController::class, 'search']);

//Discount Code
Route::get('DiscountCode', [DiscountCodeController::class, 'index']);
Route::post('DiscountCode', [DiscountCodeController::class, 'create']);
Route::get('DiscountCode/{id}', [DiscountCodeController::class, 'show']);
Route::put('DiscountCode/{id}', [DiscountCodeController::class, 'update']);
Route::delete('DiscountCode/{id}', [DiscountCodeController::class, 'delete']);
Route::get('DiscountCode/search', [DiscountCodeController::class, 'search']);
//Size
Route::get('Size', [SizeController::class, 'index']);
Route::post('Size', [SizeController::class, 'create']);
Route::get('Size/{id}', [SizeController::class, 'show']);
Route::put('Size/{id}', [SizeController::class, 'update']);
Route::delete('Size/{id}', [SizeController::class, 'delete']);
Route::get('Size/search', [SizeController::class, 'search']);
