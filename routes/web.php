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

    //sale-off
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