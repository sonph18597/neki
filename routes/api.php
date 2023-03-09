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
    // SaleOff
    Route::get('sale-off', [SaleOffController::class, 'index'])->name('sale_off.index');
    Route::post('sale-off', [SaleOffController::class, 'addSaleOff'])->name('sale_off.addSaleOff');
    Route::get('sale-off/{id}', [SaleOffController::class, 'listSaleOff'])->name('sale_off.listSaleOff');
    Route::match (['put', 'patch'], 'sale-off/{id}', [SaleOffController::class, 'updateSaleOff'])->name('sale_off.updateSaleOff');
    Route::delete('sale-off/{id}', [SaleOffController::class, 'deleteSaleOff'])->name('sale_off.deleteSaleOff');

    // SanPhamSale
    Route::get('san-pham-sale', [SanPhamSaleController::class, 'index'])->name('san_pham_sale.index');
    Route::post('san-pham-sale', [SanPhamSaleController::class, 'store'])->name('san_pham_sale.store');
    Route::get('san-pham-sale/{id}', [SanPhamSaleController::class, 'show'])->name('san_pham_sale.show');
    Route::match (['put', 'patch'], 'san-pham-sale/{id}', [SanPhamSaleController::class, 'update'])->name('san_pham_sale.update');
    Route::delete('san-pham-sale/{id}', [SanPhamSaleController::class, 'destroy'])->name('san_pham_sale.destroy');

});


Route::get('mau-sac', [MauSacController::class, 'index']);
Route::post('mau-sac', [MauSacController::class, 'store']);
Route::get('mau-sac/{id}', [MauSacController::class, 'show']);
Route::put('mau-sac/{id}', [MauSacController::class, 'update']);
Route::delete('mau-sac/{id}', [MauSacController::class, 'destroy']);

Route::get('dia-chi', [DiaChiController::class, 'index']);
Route::post('dia-chi', [DiaChiController::class, 'store']);
Route::get('dia-chi/{id}', [DiaChiController::class, 'show']);
Route::put('dia-chi/{id}', [DiaChiController::class, 'update']);
Route::delete('dia-chi/{id}', [DiaChiController::class, 'destroy']);