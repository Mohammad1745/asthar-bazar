<?php

use Illuminate\Support\Facades\Route;

Route::get('order', "OrderController@order")->name('order');
Route::get('order/list', "OrderController@orderList")->name('order.list');
Route::get('order/details/{encryptedOrderId}', "OrderController@orderDetails")->name('order.details');
Route::post('order/place-order', "OrderController@placeOrder")->name('order.placeOrder');
