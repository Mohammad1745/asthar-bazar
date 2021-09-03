<?php

use Illuminate\Support\Facades\Route;

Route::get('type', "TypeController@type")->name('admin.type');
Route::get('type/list', "TypeController@typeList")->name('admin.type.list');
Route::post('type/store', "TypeController@store")->name('admin.type.store');
Route::post('type/update', "TypeController@update")->name('admin.type.update');
Route::get('type/details/{encryptedTypeId}', "TypeController@details")->name('admin.type.details');
Route::get('type/delete/{encryptedTypeId}', "TypeController@delete")->name('admin.type.delete');
