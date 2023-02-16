<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamDonHangController;

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

Route::get('get_don_hang', [DonHangController::class, 'getDonHang']);
Route::post('add_don_hang', [DonHangController::class, 'addDonHang']);
Route::post('delete_don_hang', [DonHangController::class, 'deleteDonHang']);
Route::put('update_don_hang', [DonHangController::class, 'updateDonHang']);
Route::get('get_san_pham_don_hang', [SanPhamDonHangController::class, 'getSanPhamDonHang']);
Route::post('add_san_pham_don_hang', [SanPhamDonHangController::class, 'addSanPhamDonHang']);
Route::post('delete_san_pham_don_hang', [SanPhamDonHangController::class, 'deleteSanPhamDonHang']);
Route::put('update_san_pham_don_hang', [SanPhamDonHangController::class, 'updateSanPhamDonHang']);
