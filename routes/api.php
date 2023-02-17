<?php

use App\Http\Controllers\Api\DiaChiController;
use App\Http\Controllers\Api\MauSacController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamDonHangController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\SoLuongGiaController;
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
//user
Route::get('user', [UserController::class, 'index']);
Route::post('add_user', [UserController::class, 'store']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

//soluong_gia
Route::get('hoa_don', [SoLuongGiaController::class, 'index']);

Route::get('get_don_hang', [DonHangController::class, 'getDonHang']);
Route::post('add_don_hang', [DonHangController::class, 'addDonHang']);
Route::post('delete_don_hang', [DonHangController::class, 'deleteDonHang']);
Route::put('update_don_hang', [DonHangController::class, 'updateDonHang']);
Route::get('get_san_pham_don_hang', [SanPhamDonHangController::class, 'getSanPhamDonHang']);
Route::post('add_san_pham_don_hang', [SanPhamDonHangController::class, 'addSanPhamDonHang']);
Route::post('delete_san_pham_don_hang', [SanPhamDonHangController::class, 'deleteSanPhamDonHang']);
Route::put('update_san_pham_don_hang', [SanPhamDonHangController::class, 'updateSanPhamDonHang']);


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


