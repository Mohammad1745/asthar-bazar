<?php

Route::get('account', "AccountController@account")->name('superAdmin.account');

Route::get('account/transactions', "AccountController@transactions")->name('superAdmin.account.transactions');
