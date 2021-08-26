<?php

use Illuminate\Support\Facades\Route;

Route::get('collection', "CollectionController@collection")->name('admin.collection');;
//Collections
Route::get('collection/list', "CollectionController@collectionList")->name('admin.collection.list');
Route::post('collection/store', "CollectionController@store")->name('admin.collection.store');
Route::post('collection/update', "CollectionController@update")->name('admin.collection.update');
Route::get('collection/delete/{encryptedCollectionId}', "CollectionController@delete")->name('admin.collection.delete');
Route::get('collection/details/{encryptedCollectionId}', "CollectionController@details")->name('admin.collection.details');
//Items
Route::get('collection/item/list/{encryptedCollectionId}', "CollectionController@collectionItemList")->name('admin.collection.itemList');
Route::get('collection/item/refresh/{encryptedCollectionId}', "CollectionController@refreshItem")->name('admin.collection.refreshItem');
Route::post('collection/item/store', "CollectionController@storeItem")->name('admin.collection.storeItem');
Route::post('collection/item/update', "CollectionController@updateItem")->name('admin.collection.updateItem');
Route::get('collection/item/delete/{encryptedCollectionItemId}', "CollectionController@deleteItem")->name('admin.collection.deleteItem');
Route::get('collection/item/details/{encryptedCollectionItemId}', "CollectionController@itemDetails")->name('admin.collection.itemDetails');
