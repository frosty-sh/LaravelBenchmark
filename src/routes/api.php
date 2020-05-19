<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Performance\Performance;

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

Route::get('/customers', function (){
    Performance::point();
    $users = DB::table('Customers')->select('*')->get();
    Performance::point();
    $json = $users->toJson();
    Performance::finish();
    Performance::results();
    return $json;
});

Route::get('/orders', function (){
    Performance::point();
    $orders = App\Order::with('Customer.Contact')->with('OrderItems.Product')->get();
    Performance::point();
    $json = $orders->toJson();
    Performance::results();
    return $orders;
});

Route::get('/customersql', function (){
    return App\Customer::all();
});