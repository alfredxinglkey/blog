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

//用户模块
//注册页面
Route::get('/register', 'RegisterController@index');
//注册行为
Route::post('/register', 'RegisterController@register');
//登录页面
Route::get('/login', 'LoginController@index');
//登陆行为
Route::post('/login', 'LoginController@login');
//登出行为
Route::get('/logout', 'LoginController@logout');
//个人设置页面
Route::get('/user/me/setting', 'UserController@setting');
//个人设置操作
Route::post('/user/me/setting', 'UserController@SettingStore');

//文章模块
Route::resource('posts', 'PostController');