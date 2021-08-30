<?php

use Illuminate\Support\Facades\Route;

Route::get('news', "NewsController@news")->name('superAdmin.news');
Route::get('news/list', "NewsController@newsList")->name('superAdmin.news.list');
Route::post('news/store', "NewsController@store")->name('superAdmin.news.store');
Route::post('news/update', "NewsController@update")->name('superAdmin.news.update');
Route::get('news/details/{encryptedNewsId}', "NewsController@details")->name('superAdmin.news.details');
Route::get('news/delete/{encryptedNewsId}', "NewsController@delete")->name('superAdmin.news.delete');
