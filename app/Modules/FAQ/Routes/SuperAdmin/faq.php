<?php

Route::get('faq', "FAQController@faq")->name('superAdmin.faq');
Route::post('faq/update', "FAQController@update")->name('superAdmin.faq.update');
