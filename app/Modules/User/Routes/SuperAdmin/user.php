<?php

use Illuminate\Support\Facades\Route;

Route::get('user', "UserController@user")->name('superAdmin.user');
Route::get('user/list', "UserController@userList")->name('superAdmin.user.list');
Route::post('user/store', "UserController@store")->name('superAdmin.user.store');
Route::post('user/update', "UserController@update")->name('superAdmin.user.update');
Route::get('user/details/{encryptedUserId}', "UserController@details")->name('superAdmin.user.details');
Route::get('user/restore/{encryptedUserId}', "UserController@restore")->name('superAdmin.user.restore');
Route::get('user/delete/{encryptedUserId}', "UserController@delete")->name('superAdmin.user.delete');
