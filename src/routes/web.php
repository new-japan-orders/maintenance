<?php

Route::get('/maintenances', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@index')->name('maintenances.index');
Route::get('/maintenances/create', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@create')->name('maintenances.create');
Route::post('/maintenances/store', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@store')->name('maintenances.store');
Route::get('/maintenances/edit/{id}', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@edit')->name('maintenances.edit');
Route::post('/maintenances/update/{id}', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@update')->name('maintenances.update');
Route::get('/maintenances/finish/{id}', 'NewJapanOrders\Maintenance\Controllers\MaintenanceController@finish')->name('maintenances.finish');
