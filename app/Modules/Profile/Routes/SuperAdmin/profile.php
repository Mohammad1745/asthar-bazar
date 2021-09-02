<?php

use Illuminate\Support\Facades\Route;

Route::get('profile', "ProfileController@profile")->name('superAdmin.profile');
Route::post('profile/update', "ProfileController@update")->name('superAdmin.profile.update');
Route::post('profile/update-password', "ProfileController@updatePassword")->name('superAdmin.profile.updatePassword');
