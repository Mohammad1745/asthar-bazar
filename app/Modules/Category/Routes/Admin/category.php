<?php

use Illuminate\Support\Facades\Route;

Route::get('category', "CategoryController@category")->name('admin.category');
Route::get('category/list', "CategoryController@categoryList")->name('admin.category.list');
Route::post('category/store', "CategoryController@store")->name('admin.category.store');
Route::post('category/update', "CategoryController@update")->name('admin.category.update');
Route::get('category/details/{encryptedCategoryId}', "CategoryController@details")->name('admin.category.details');
Route::get('category/delete/{encryptedCategoryId}', "CategoryController@delete")->name('admin.category.delete');
