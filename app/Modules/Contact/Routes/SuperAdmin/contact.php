<?php

Route::get('contact', "ContactMessageController@contact")->name('superAdmin.contact');
Route::get('contact/list', "ContactMessageController@contactMessageList")->name('superAdmin.contactMessage.list');
Route::get('contact/details/{encryptedContactMessageId}', "ContactMessageController@details")->name('superAdmin.contactMessage.details');
Route::post('contact/reply', "ContactMessageController@reply")->name('superAdmin.contactMessage.reply');
