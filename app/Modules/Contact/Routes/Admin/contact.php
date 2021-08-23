<?php

Route::get('contact', "ContactMessageController@contact")->name('admin.contact');
Route::get('contact/list', "ContactMessageController@contactMessageList")->name('admin.contactMessage.list');
Route::get('contact/details/{encryptedContactMessageId}', "ContactMessageController@details")->name('admin.contactMessage.details');
Route::post('contact/reply', "ContactMessageController@reply")->name('admin.contactMessage.reply');
