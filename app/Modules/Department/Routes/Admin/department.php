<?php

Route::get('department', "DepartmentController@department")->name('admin.department');
Route::get('department/sale-record', "DepartmentController@saleRecord")->name('admin.department.saleRecord');
Route::get('department/sale-record/list', "DepartmentController@saleRecordList")->name('admin.department.saleRecord.list');
