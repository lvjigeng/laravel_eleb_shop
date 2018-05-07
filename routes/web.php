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
//报名活动
Route::get('signUp','IndexController@signUp')->name('activity.signUp');
//活动中奖名单
Route::get('winning','IndexController@winning')->name('activity.winning');
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

//订单列表路由
Route::get('order','OrderController@index')->name('order.index');
//订单详情
Route::get('order/{order}/show','OrderController@show')->name('order.show');
//订单发货路由
Route::get('order/sendGoods','OrderController@sendGoods')->name('order.sendGoods');
//订单取消路由
Route::get('order/cancel','OrderController@cancel')->name('order.cancel');

//订单统主页
Route::get('count','CountController@index')->name('count.index');
//订单计算数量
Route::get('count/playing','CountController@playing')->name('count.playing');
//商品销售数量主页
Route::get('count/foodsIndex','CountController@foodsIndex')->name('count.foodsIndex');
//商品销售数量主页
Route::get('count/foodsCount','CountController@foodsCount')->name('count.foodsCount');