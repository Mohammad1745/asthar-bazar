<?php

use Illuminate\Support\Facades\Route;

Route::get('faq/{faq}', "FAQController@faq")->name('faq');
