<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Charge;
use Stripe\Stripe;

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
Route::post('/checkout', 'PaymentCheckoutController@checkout');


Route::get('/', function () {
    return view('welcome');
});
Route::get('importExportView', 'ReportController@export');


Route::post('send-token', 'ResetPassword@sendToken');
Route::post('valid-token', 'ResetPassword@validateToken');
Route::post('reset-password', 'ResetPassword@resetPassword');
