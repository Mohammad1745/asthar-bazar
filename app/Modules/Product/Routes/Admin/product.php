<?php

Route::get('product', "ProductController@product")->name('admin.product');
//Products
Route::get('product/list', "ProductController@productList")->name('admin.product.list');
Route::post('product/store', "ProductController@store")->name('admin.product.store');
Route::post('product/update', "ProductController@update")->name('admin.product.update');
Route::get('product/delete/{encryptedProductId}', "ProductController@delete")->name('admin.product.delete');
Route::get('product/details/{encryptedProductId}', "ProductController@details")->name('admin.product.details');
//Variations
Route::get('product/variation/list/{encryptedProductId}', "ProductController@productVariationList")->name('admin.product.variationList');
Route::post('product/variation/store', "ProductController@storeVariation")->name('admin.product.storeVariation');
Route::post('product/variation/update', "ProductController@updateVariation")->name('admin.product.updateVariation');
Route::get('product/variation/delete/{encryptedProductVariationId}', "ProductController@deleteVariation")->name('admin.product.deleteVariation');
Route::get('product/variation/details/{encryptedProductVariationId}', "ProductController@variationDetails")->name('admin.product.variationDetails');
