<?php

use App\Http\Controllers\SaleOffController;
use App\Http\Controllers\SanPhamSaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout']);

Route::middleware(['auth'])->group(function () {
    // tất cả đường link muốn bảo vệ chỉ cần viết vào đây
    //user
    Route::get('/user', 'UserController@index')->name('route_BackEnd_User_index');

   
});
 //sale-off
 Route::get('sale-off', [SaleOffController::class, 'index']);
 Route::match(['get','post'],'add-sale-off', [SaleOffController::class, 'addSaleOff'])->name('admin.sale_off.add');
 Route::get('sale-off/{id}', [SaleOffController::class, 'listSaleOff']);
 Route::match(['put', 'patch'], 'sale-off/update/{id}', [SaleOffController::class, 'updateSaleOff']);
 Route::delete('sale-off/delete/{id}', [SaleOffController::class, 'deleteSaleOff']);


 // SanPhamSale
 Route::get('san-pham-sale', [SanPhamSaleController::class, 'index'])->name('san_pham_sale.index');
 Route::match(['get','post'],'add-san-pham-sale', [SanPhamSaleController::class, 'addSanPhamSale'])->name('admin.san_pham_sale.add');
//  Route::post('san-pham-sale', [SanPhamSaleController::class, 'addSanPhamSale'])->name('san_pham_sale.addSanPhamSale');
 Route::get('san-pham-sale/{id}', [SanPhamSaleController::class, 'listSanPhamSale'])->name('san_pham_sale.listSanPhamSale');
 Route::match(['put', 'patch'], 'san-pham-sale/{id}', [SanPhamSaleController::class, 'updateSanPhamSale'])->name('san_pham_sale.updateSanPhamSale');
 Route::delete('san-pham-sale/{id}', [SanPhamSaleController::class, 'deleteSanPhamSale'])->name('san_pham_sale.deleteSanPhamSale');
