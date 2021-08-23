<?php

Route::get('contact', "ContactMessageController@contact")->name('contact');
Route::post('contact/store', "ContactMessageController@store")->name('contactMessage.store');
