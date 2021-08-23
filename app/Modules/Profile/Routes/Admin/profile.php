<?php

Route::get('profile', "ProfileController@profile")->name('admin.profile');
Route::post('profile/update', "ProfileController@update")->name('admin.profile.update');
Route::post('profile/update-password', "ProfileController@updatePassword")->name('admin.profile.updatePassword');
