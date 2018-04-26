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

Route::post('/upload','UploadController@upload');



//登录首页
Route::get('/','IndexController@welcome')->name('/');
//店铺首页
Route::get('index','IndexController@index')->name('index');
//活动查看
Route::get('show/{activity}','IndexController@show')->name('activity.show');
Route::get('qainShow/{activity}','IndexController@qianShow')->name('activity.qianShow');

//注册
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
//食品分类路由
Route::resource('foodCategory','FoodCategoryController');
//食品路由
Route::resource('food','FoodController');
