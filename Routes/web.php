<?php

Route::middleware('auth')->group(function() {
    Route::get('/home', 'DashboardController@index')->name('dashboard');
    Route::get('/', 'DashboardController@index')->name('dashboard');
});


Route::prefix('sallers')->middleware('auth')->group(function() {
    Route::get('', 'SallerController@index')->name('sallers.index');
    Route::get('create', 'SallerController@create')->name('sallers.create');
    Route::get('{saller}/edit', 'SallerController@edit')->name('sallers.edit');

    Route::post('', 'SallerController@store')->name('sallers.store');
    Route::put('{saller}', 'SallerController@update')->name('sallers.update');
    Route::delete('{saller}/destroy', 'SallerController@destroy')->name('sallers.destroy');		
});

Route::prefix('payments')->middleware('auth')->group(function() {
    Route::get('', 'PaymentController@index')->name('payments.index');
    Route::get('create', 'PaymentController@create')->name('payments.create');
    Route::get('{payment}/edit', 'PaymentController@edit')->name('payments.edit');

    Route::post('', 'PaymentController@store')->name('payments.store');
    Route::put('{payment}', 'PaymentController@update')->name('payments.update');
    Route::delete('{payment}/destroy', 'PaymentController@destroy')->name('payments.destroy');		
});


Route::prefix('imports')->middleware('auth')->group(function() {
    Route::get('', 'ImportController@index')->name('imports.index');
    Route::get('saller', 'ImportController@saller')->name('imports.saller');
    Route::get('payment', 'ImportController@payment')->name('imports.payment');


    Route::get('widget/update', 'ImportController@update')->name('imports.widget.update');
    Route::get('widget/report/{file_name}', 'ImportController@report')->name('imports.widget.report');

    Route::post('widget/upload', 'ImportController@upload')->name('imports.widget.upload');
    Route::post('widget/start', 'ImportController@start')->name('imports.widget.start');
});


Route::prefix('companies')->middleware('auth')->group(function() 
{
	Route::get('{tab}', 'CompanyController@edit')->name('companies.edit');
	Route::post('logo', 'CompanyController@logo')->name('companies.logo');
	Route::put('', 'CompanyController@update')->name('company.update');
});