<?php

use Illuminate\Support\Facades\Route;

Route::get('account', "AccountController@account")->name('admin.account');

Route::get('account/transactions', "AccountController@transactions")->name('admin.account.transactions');
