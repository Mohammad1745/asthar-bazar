<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', "DashboardController@dashboard")->name('admin.dashboard');
