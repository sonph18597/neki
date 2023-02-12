<?php

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
Route::middleware(['auth'])->group(function () {
    //shoes
    Route::get('/Shoes', 'ShoesController@index');
    Route::match(['get', 'post'], '/Shoes/add', 'ShoesController@add')
        ->name('Router_BackEnd_Shoes_Add');
    Route::get('/Shoes/detail/{id}', 'ShoesController@detail')
        ->name('Router_BackEnd_Shoes_Detail');
    Route::post('/Shoes/update/{id}', 'ShoesController@update')
        ->name('Router_BackEnd_Shoes_Update');
    Route::get('/Shoes/destroy/{id}', 'ShoesController@destroy')
        ->name('Router_BackEnd_Shoes_Destroy');
        //discountCode
        Route::get('/DiscountCode', 'DiscountCodeController@index');
    Route::match(['get', 'post'], '/DiscountCode/add', 'DiscountCodeController@add')
        ->name('Router_BackEnd_DiscountCode_Add');
    Route::get('/DiscountCode/detail/{id}', 'DiscountCodeController@detail')
        ->name('Router_BackEnd_DiscountCode_Detail');
    Route::post('/DiscountCode/update/{id}', 'DiscountCodeController@update')
        ->name('Router_BackEnd_DiscountCode_Update');
    Route::get('/DiscountCode/destroy/{id}', 'DiscountCodeController@destroy')
        ->name('Router_BackEnd_DiscountCode_Destroy');
});
