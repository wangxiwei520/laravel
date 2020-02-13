<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//login
Route::post('/adminLoginVer','Admin\LoginController@login');//登录
Route::post('/register','Admin\LoginController@register');//注册
Route::post('/logout','Admin\LoginController@logout');//退出登录
Route::post('/refresh','Admin\LoginController@refresh');//刷新
Route::post('/checkIsLogin','Admin\LoginController@checkIsLogin');//验证
//user
Route::post('/userInfo','Admin\UserController@userInfo');//验证