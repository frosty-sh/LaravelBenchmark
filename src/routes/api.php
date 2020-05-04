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

Route::get('/customers', function (){
    $users = DB::table('Customers')->select('*')->get();
    $json = $users->toJson();
    return $json;
});

Route::get('/orders', function (){
    // $orders = DB::table('Orders')
    // ->join('Customers', 'Orders.CustomerId', '=', 'Customers.Id')
    // ->join('OrderItems', 'Orders.Id', '=', 'OrderItems.OrderId')
    // ->select('*')
    // ->get();
    return App\Order::with('Customer.Contact')->with('OrderItems.Product')->get();
});