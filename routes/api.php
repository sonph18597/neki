<?php

use App\Http\Controllers\AnhController;
use App\Http\Controllers\Api\DiaChiController;
use App\Http\Controllers\Api\MauSacController;
use App\Http\Controllers\SaleOffController;
use App\Http\Controllers\SanPhamSaleController;
use App\Models\SanPhamSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\ShoesController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamDonHangController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\SoLuongGiaController;
use \App\Http\Controllers\LoaiController;
use App\Http\Controllers\ThongKeController;

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
Route::get('shoes', [ShoesController::class, 'getAllShoes']);
Route::post('shoes', [ShoesController::class, 'addShoes']);
Route::get('shoes/{id}', [ShoesController::class, 'getOneShoes']);
Route::put('shoes/{id}', [ShoesController::class, 'updateShoes']);
Route::delete('shoes/{id}', [ShoesController::class, 'deleteShoes']);

//Discount Code
Route::get('discountcode', [DiscountCodeController::class, 'getAllDiscountCode']);
Route::post('discountcode', [DiscountCodeController::class, 'addDiscountCode']);
Route::get('discountcode/{id}', [DiscountCodeController::class, 'getOneDiscountCode']);
Route::put('discountcode/{id}', [DiscountCodeController::class, 'updateDiscountCode']);
Route::delete('discountcode/{id}', [DiscountCodeController::class, 'deleteDiscountCode']);
//Size

Route::get('size', [SizeController::class, 'getAllSize']);
Route::post('size', [SizeController::class, 'addSize']);
Route::get('size/{id}', [SizeController::class, 'getOneSize']);
Route::put('size/{id}', [SizeController::class, 'updateSize']);
Route::delete('size/{id}', [SizeController::class, 'deleteSize']);


//user
Route::get('user', [UserController::class, 'getAllUser']);
Route::post('user', [UserController::class, 'addUser']);
Route::get('user/{id}', [UserController::class, 'getOneUser']);
Route::put('user/{id}', [UserController::class, 'updateUser']);
Route::delete('user/{id}', [UserController::class, 'deleteUser']);

//Loai
Route::get('loai', [LoaiController::class, 'getAllLoai']);
Route::post('loai', [LoaiController::class, 'addLoai']);
Route::get('loai/{id}', [LoaiController::class, 'getOneLoai']);
Route::put('loai/{id}', [LoaiController::class, 'updateLoai']);
Route::delete('loai/{id}', [LoaiController::class, 'deleteLoai']);

//soluong_gia
Route::get('hoa-don', [SoLuongGiaController::class, 'getAllSoLuongGia']);
Route::post('hoa-don', [SoLuongGiaController::class, 'addSoLuongGia']);
Route::get('hoa-don/{id}', [SoLuongGiaController::class, 'getOneSoLuongGia']);
Route::put('hoa-don/{id}', [SoLuongGiaController::class, 'updateSoLuongGia']);
Route::delete('hoa-don/{id}', [SoLuongGiaController::class, 'deleteSoLuongGia']);

//don hang
Route::get('don-hang', [DonHangController::class, 'getAllDonHang']);
Route::post('don-hang', [DonHangController::class, 'addDonHang']);
Route::put('don-hang/{id}', [DonHangController::class, 'updateDonHang']);
Route::get('don-hang/{id}', [DonHangController::class, 'getOnedonHang']);

Route::get('san_pham_don_hang', [SanPhamDonHangController::class, 'getSanPhamDonHang']);
Route::post('san_pham_don_hang', [SanPhamDonHangController::class, 'addSanPhamDonHang']);
Route::put('san_pham_don_hang/{id}', [SanPhamDonHangController::class, 'updateSanPhamDonHang']);
Route::get('san_pham_don_hang/{id}', [SanPhamDonHangController::class, 'getOneSanPhamDonHang']);

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

//Ảnh
Route::get('anh', [AnhController::class, 'getAllAnh']);
Route::post('anh', [AnhController::class, 'addAnh']);
Route::get('anh/{id}', [AnhController::class, 'getOneAnh']);
Route::put('anh/{id}', [AnhController::class, 'updateAnh']);
Route::delete('anh/{id}', [AnhController::class, 'deleteAnh']);

//thong ke
Route::get('tong-tien-don-hang-cac-thang-truoc', [ThongKeController::class, 'tongTienDonHangCacThangTruoc']);

