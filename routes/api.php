<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//auth routes
Route::post('uploadData', 'API\V1\UserController@upload');
Route::post('login', 'API\V1\UserController@login');
Route::post('register', 'API\V1\UserController@register');
Route::middleware('auth:api')->get('logout', 'API\V1\UserController@logout');

Route::get('getupdate/{id}', 'API\V1\UserController@getdata');
Route::post('update_post', 'API\V1\UserController@update');
Route::post('delete_post/{id}', 'API\V1\UserController@delete');


Route::get('province', 'API\V1\UserController@getprovince');
Route::get('districts/{id}', 'API\V1\UserController@getdistricts');
Route::get('communes/{dis_id}', 'API\V1\UserController@getcommunes');

Route::middleware('auth:api')->get('getpost', 'API\V1\UserController@getpost');
Route::middleware('auth:api')->get('getpromote', 'API\V1\ProductController@getpromote');

Route::get('getproduct', 'API\V1\ProductController@getpro');
Route::get('map', 'API\V1\ProductController@map');
Route::get('vieDetail/{id}', 'API\V1\ProductController@Detail');
Route::get('macadd', 'PaymentCheckoutController@getMacAddress');
Route::post('searchdata', 'API\V1\ProductController@search');
Route::get('getcategory/{cat}', 'API\V1\ProductController@procategory');
Route::get('promote', 'API\V1\ProductController@Promote');

Route::post('/checkout', 'PaymentCheckoutController@checkout');
Route::post('getfavorite', 'API\V1\ProductController@getfavorite');
Route::post('userdata', 'API\V1\ProductController@userdata');
Route::get('checkuserdata/{id}', 'API\V1\ProductController@checkuserdata');

//Promote
Route::get('AdvertiseDefault', 'API\V1\ProductController@AdvertiseDefault');
Route::post('AdvertiseUser', 'API\V1\ProductController@AdvertiseUser');
Route::get('viewers/{id}', 'API\V1\ProductController@viewer');

Route::get('viewer/avg', 'API\V1\ProductController@viewerAvg');
Route::get('viewerpromote/{id}', 'API\V1\ProductController@viewerpromote');

///Admin
Route::get('userlist', 'AdminController@UserList');
Route::get('disable/{id}/{disable}', 'AdminController@disable');
Route::get('disablepro/{id}/{disable}', 'AdminController@disablepro');
Route::get('DeleteUser/{id}', 'AdminController@DeleteUser');
Route::get('deletepro/{id}', 'AdminController@deletepro');
Route::get('estatelist', 'AdminController@estatelist');
Route::get('EstatePromoted', 'AdminController@EstatePromoted');
Route::get('DeletePromote/{id}', 'AdminController@DeletePromote');
Route::get('disablePromote/{id}/{disable}', 'AdminController@disablePromote');


Route::get('test', 'AdminController@test');

//Report Export
Route::get('export', 'AdminController@exportExcel');
