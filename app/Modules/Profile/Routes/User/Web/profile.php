<?php

use Illuminate\Support\Facades\Route;

Route::get('profile', "ProfileController@profile")->name('profile');
Route::post('profile/update', "ProfileController@update")->name('profile.update');
Route::post('profile/update-password', "ProfileController@updatePassword")->name('profile.updatePassword');
