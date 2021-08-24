<?php

use Illuminate\Support\Facades\Route;

Route::get('cart', "CartController@cart")->name('cart');
Route::get('cart/clear', "CartController@clear")->name('cart.clear');
Route::post('cart/update', "CartController@update")->name('cart.update');
Route::get('cart/add-product/{encryptedProductVariationId}', "CartController@addProductVariation")->name('cart.addProductVariation');
Route::get('cart/checkout', "CartController@checkout")->name('cart.checkout');


