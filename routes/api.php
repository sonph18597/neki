<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ColorController;
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

Route::get('color', [ColorController::class, 'index']);
Route::post('color', [ColorController::class, 'store']);
Route::get('color/{id}', [ColorController::class, 'show']);
Route::put('color/{id}', [ColorController::class, 'update']);
Route::delete('color/{id}', [ColorController::class, 'destroy']);

Route::get('address', [AddressController::class, 'index']);
Route::post('address', [AddressController::class, 'store']);
Route::get('address/{id}', [AddressController::class, 'show']);
Route::put('address/{id}', [AddressController::class, 'update']);
Route::delete('address/{id}', [AddressController::class, 'destroy']);


