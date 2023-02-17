<?php

use App\Http\Controllers\Api\DiaChiController;
use App\Http\Controllers\Api\MauSacController;
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


