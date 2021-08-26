<?php

use Illuminate\Support\Facades\Route;

Route::get('department', "DepartmentController@department")->name('superAdmin.department');
Route::get('department/list', "DepartmentController@departmentList")->name('superAdmin.department.list');
Route::post('department/store', "DepartmentController@store")->name('superAdmin.department.store');
Route::post('department/update', "DepartmentController@update")->name('superAdmin.department.update');
Route::get('department/details/{encryptedDepartmentId}', "DepartmentController@details")->name('superAdmin.department.details');
Route::get('department/activate/{encryptedDepartmentId}', "DepartmentController@activate")->name('superAdmin.department.activate');
Route::get('department/deactivate/{encryptedDepartmentId}', "DepartmentController@deactivate")->name('superAdmin.department.deactivate');
Route::get('department/payment-done/{encryptedDepartmentId}', "DepartmentController@paymentDone")->name('superAdmin.department.paymentDone');
//Sale Record List
Route::get('department/sale-record/list/{encryptedDepartmentId}', "DepartmentController@saleRecordList")->name('superAdmin.department.saleRecord.list');
Route::get('department/product-variation/list/{encryptedDepartmentId}', "DepartmentController@productVariationList")->name('superAdmin.department.productVariation.list');
