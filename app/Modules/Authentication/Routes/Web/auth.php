<?php

Route::get('/auth', "AuthController@auth")->name('auth');

Route::get('sign-up', "AuthController@signUp")->name('signUp');
Route::post('sign-up', "AuthController@signUpProcess")->name('signUpProcess');
Route::get('email-verification-code', "AuthController@emailVerificationCode")->name('emailVerificationCode');
Route::get('verify-email', "AuthController@verifyEmail")->name('verifyEmail');
Route::post('verify-email', "AuthController@verifyEmailProcess")->name('verifyEmailProcess');
Route::get('sign-in', "AuthController@signIn")->name('signIn');
Route::post('sign-in', "AuthController@signInProcess")->name('signInProcess');
Route::get('forget-password', "AuthController@forgetPassword")->name('forgetPassword');
Route::post('forget-password-email-send', "AuthController@forgetPasswordEmailSendProcess")->name('forgetPasswordEmailSendProcess');
Route::get('reset-password-code', "AuthController@forgetPasswordCode")->name('forgetPasswordCode');
Route::post('reset-password-code', "AuthController@forgetPasswordCodeProcess")->name('forgetPasswordCodeProcess');

Route::group(['middleware' => 'auth'], function () {
    Route::get('sign-out', 'AuthController@signOut')->name('signOut');
});
