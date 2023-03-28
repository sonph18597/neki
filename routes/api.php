<?php

use App\Http\Controllers\Api\DiaChiController;
use App\Http\Controllers\Api\MauSacController;
use App\Http\Controllers\SaleOffController;
use App\Http\Controllers\SanPhamSaleController;
use App\Models\SanPhamSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// SaleOff
Route::get('sale-off', [SaleOffController::class, 'index']);
Route::post('sale-off', [SaleOffController::class, 'addSaleOff']);
Route::get('sale-off/{id}', [SaleOffController::class, 'listSaleOff']);
Route::match(['put', 'patch'], 'sale-off/{id}', [SaleOffController::class, 'updateSaleOff']);
Route::delete('sale-off/{id}', [SaleOffController::class, 'deleteSaleOff']);
Route::get('sale-off', [SaleOffController::class, 'search']);


// SanPhamSale
Route::get('san-pham-sale', [SanPhamSaleController::class, 'index']);
Route::post('san-pham-sale', [SanPhamSaleController::class, 'addSanPhamSale']);
Route::get('san-pham-sale/{id}', [SanPhamSaleController::class, 'listSanPhamSale']);
Route::match(['put', 'patch'], 'san-pham-sale/{id}', [SanPhamSaleController::class, 'updateSanPhamSale']);
Route::delete('san-pham-sale/{id}', [SanPhamSaleController::class, 'deleteSanPhamSale']);
Route::get('san-pham-sale', [SanPhamSaleController::class, 'search']);

