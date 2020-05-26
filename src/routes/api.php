<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Performance\Performance;
use Carbon\Carbon;

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

Route::get('/contactsJSON', function (){
    Performance::point();
    $contacts = App\Contact::all();
    Performance::point();
    $export = Performance::export();
    print_r($export->toFile(Carbon::now()->format('j_H-m-s') . '_single.json'));
    return $contacts;
});

Route::get('/contacts', function (){
    return App\Contact::all();
});

Route::get('/ordersJSON', function (){
    Performance::point();
    $orders = App\Order::with('Customer.Contact')->with('OrderItems.Product')->get();
    Performance::point();
    $export = Performance::export();
    print_r($export->toFile(Carbon::now()->format('j_H-m-s') . '_multiple.json'));
    return $orders;
});

Route::get('/orders', function (){
    return App\Order::with('Customer.Contact')->with('OrderItems.Product')->get();;
});