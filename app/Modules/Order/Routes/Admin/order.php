<?php

use Illuminate\Support\Facades\Route;

Route::get('order', "OrderController@order")->name('admin.order');
Route::get('order/list', "OrderController@orderList")->name('admin.order.list');
Route::get('order/details/{encryptedOrderId}', "OrderController@orderDetails")->name('admin.order.details');
Route::post('order/store-charge', "OrderController@storeCharge")->name('admin.order.storeCharge');
Route::get('order/done-payment/{encryptedOrderId}', "OrderController@donePayment")->name('admin.order.donePayment');
Route::get('order/complete-order/{encryptedOrderId}', "OrderController@completeOrder")->name('admin.order.completeOrder');
Route::get('order/cancel-order/{encryptedOrderId}', "OrderController@cancelOrder")->name('admin.order.cancelOrder');
