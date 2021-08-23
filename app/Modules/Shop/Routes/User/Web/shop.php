<?php

Route::get('shop', "ShopController@shop")->name('shop');
Route::get('shop/department/{encryptedDepartmentId}&{encryptedCategoryId}&{encryptedTypeId}', "ShopController@department")->name('shop.department');
Route::get('shop/department/product/{encryptedProductVariationId}', "ShopController@productVariation")->name('shop.department.productVariation');


