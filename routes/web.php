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
//登录首页
Route::get('/', function () {
    return view('welcome');
});
//店铺首页
Route::get('index','IndexController@index')->name('index');
Route::get('register','ShopAccountController@register')->name('register');
Route::post('registerSave','ShopAccountController@registerSave')->name('registerSave');
//登录
Route::get('login','ShopAccountController@login')->name('login');
Route::post('login','ShopAccountController@login')->name('login');
//注销
Route::delete('logout','ShopAccountController@logout')->name('logout');
//修改密码
Route::get('editPwd/{shopAccount}','ShopAccountController@editPwd')->name('editPwd');
Route::post('editPwd/{shopAccount}','ShopAccountController@editPwd')->name('editPwd');

//店铺详情
Route::resource('shopDetail','ShopDetailController');