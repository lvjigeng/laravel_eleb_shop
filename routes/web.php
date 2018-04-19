<?php

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

Route::get('register','ShopAccountController@register')->name('register');
Route::post('registerSave','ShopAccountController@registerSave')->name('registerSave');
//登录
Route::get('login','ShopAccountController@login')->name('login');
Route::post('login','ShopAccountController@login')->name('login');

//店铺详情
Route::resource('shopDetail','ShopDetailController');
