<?php

use Illuminate\Support\Facades\Route;

Route::get('news', "NewsController@news")->name('news');
