<?php

use Illuminate\Support\Facades\Route;

Route::get('news', "NewsController@news")->name('admin.news');
Route::get('news/list', "NewsController@newsList")->name('admin.news.list');
Route::post('news/store', "NewsController@store")->name('admin.news.store');
Route::post('news/update', "NewsController@update")->name('admin.news.update');
Route::get('news/details/{encryptedNewsId}', "NewsController@details")->name('admin.news.details');
Route::get('news/delete/{encryptedNewsId}', "NewsController@delete")->name('admin.news.delete');
