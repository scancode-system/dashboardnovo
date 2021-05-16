<?php

Route::middleware('auth')->group(function() {
    Route::get('/home', 'DashboardController@index')->name('dashboard');
    Route::get('/', 'DashboardController@index')->name('dashboard');
});


Route::prefix('companies')->middleware('auth')->group(function() 
{
	Route::get('{tab}', 'CompanyController@edit')->name('companies.edit');
	Route::post('logo', 'CompanyController@logo')->name('companies.logo');
	Route::put('', 'CompanyController@update')->name('company.update');
});

Route::prefix('settings')->middleware('auth')->group(function() 
{
    Route::get('settings/{tab}', 'SettingController@index')->name('settings.index')->middleware('auth');
    Route::put('client', 'SettingController@updateClient')->name('settings.client.update');
    Route::put('order', 'SettingController@updateOrder')->name('settings.order.update');
    Route::put('pdf', 'SettingController@updatePdf')->name('settings.pdf.update');
    Route::put('pdf/columns', 'SettingController@updatePdfColumns')->name('settings.pdf.columns.update');
    Route::put('pdf/layouts/{pdf_layout}', 'SettingController@updatePdfLayouts')->name('settings.pdf.layouts.update');
});


Route::prefix('users')->middleware('auth')->group(function() 
{
    Route::delete('{user}/destroy', 'UserController@destroy')->name('users.destroy');	
    Route::post('', 'UserController@store')->name('users.store');
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

Route::prefix('clients')->middleware('auth')->group(function() {
	Route::get('', 'ClientController@index')->name('clients.index');
	Route::get('create', 'ClientController@create')->name('clients.create');
    Route::get('{client}/edit', 'ClientController@edit')->name('clients.edit');
    Route::get('select/{text}', 'ClientController@select');

    Route::post('', 'ClientController@store')->name('clients.store');
    Route::post('shipping', 'ClientController@storeShipping')->name('clients.store.shipping');

    Route::put('{client}', 'ClientController@update')->name('clients.update');

    Route::delete('{client}/destroy', 'ClientController@destroy')->name('clients.destroy');		
});

Route::prefix('price_tables')->middleware('auth')->group(function() {
    Route::post('', 'PriceTableStoreController')->name('price_tables.store');
});

Route::prefix('imports')->middleware('auth')->group(function() {
    Route::get('', 'ImportController@index')->name('imports.index');
    Route::get('saller', 'ImportController@saller')->name('imports.saller');
    Route::get('payment', 'ImportController@payment')->name('imports.payment');
    Route::get('client', 'ImportController@client')->name('imports.client');
    Route::get('product', 'ImportController@product')->name('imports.product');
    Route::put('product/setting', 'ImportController@productSetting')->name('imports.product.setting');


    Route::get('widget/update', 'ImportController@update')->name('imports.widget.update');
    Route::get('widget/report/{file_name}', 'ImportController@report')->name('imports.widget.report');

    Route::post('widget/upload', 'ImportController@upload')->name('imports.widget.upload');
    Route::post('widget/start', 'ImportController@start')->name('imports.widget.start');
});

Route::prefix('products')->middleware('auth')->group(function() {
	Route::get('', 'ProductController@index')->name('products.index');
	Route::get('create', 'ProductController@create')->name('products.create');
	Route::get('{product}/edit', 'ProductController@edit')->name('products.edit');
	Route::get('import', 'ProductController@import')->name('products.import');

	Route::get('select/{text}', 'ProductController@select');

	Route::post('', 'ProductController@store')->name('products.store');
    Route::post('{product}/image', 'ProductController@storeImage')->name('products.store.image');
    
    Route::post('store/color', 'ProductController@storeColor')->name('products.store.color');
    Route::post('store/size', 'ProductController@storeSize')->name('products.store.size');
    Route::post('store/subsidiary', 'ProductController@storeSubsidiary')->name('products.store.subsidiary');
    

	Route::put('{product}', 'ProductController@update')->name('products.update');
	
	Route::delete('{product}/destroy', 'ProductController@destroy')->name('products.destroy');		
});

Route::prefix('product_categories')->middleware('auth')->group(function() {
	Route::post('', 'ProductCategoryController@store')->name('product_categories.store');
}); 

Route::prefix('product_stocks')->middleware('auth')->group(function() {
	Route::put('{product_stock}', 'ProductStockController@update')->name('product_stocks.update');
});

Route::prefix('price_quantities')->middleware('auth')->group(function() {
    Route::post('{product}', 'PriceQuantityController@store')->name('price_quantities.store');
    Route::delete('{price_quantity}', 'PriceQuantityController@destroy')->name('price_quantities.destroy');
});

Route::prefix('product_price_tables')->middleware('auth')->group(function() {
    Route::post('{product}', 'ProductPriceTableController@store')->name('product_price_tables.store');
    Route::delete('{product_price_table}', 'ProductPriceTableController@destroy')->name('product_price_tables.destroy');
});

Route::prefix('orders')->middleware('auth')->group(function() {
    Route::get('', 'OrderController@index')->name('orders.index');
    Route::get('{order}/{tab?}', 'OrderController@edit')->name('orders.edit');
    Route::post('', 'OrderController@store')->name('orders.store');
    Route::post('{order}/clone', 'OrderController@clone')->name('orders.clone');
    Route::put('{order}/status', 'OrderController@update')->name('orders.update.status');	
    Route::put('{order}', 'OrderController@update')->name('orders.update')->middleware('order-locked');
    Route::delete('{order}/destroy', 'OrderController@destroy')->name('orders.destroy');
  
});

Route::prefix('items')->middleware('auth')->group(function() {
	Route::get('{product}/edit/info/ajax', 'ItemController@editInfoAjax');
	Route::post('{order}', 'ItemController@store')->name('items.store')->middleware('order-locked');
	Route::put('{item}', 'ItemController@update')->name('items.update')->middleware('order-locked');
	Route::delete('{item}/destroy', 'ItemController@destroy')->name('items.destroy')->middleware('order-locked');
});

Route::prefix('pdf')->middleware('auth')->group(function() {
    Route::get('{order}/download', 'PdfController@download')->name('pdf.download');
});

Route::prefix('reports')->middleware('auth')->group(function() {
    Route::get('', 'ReportController@index')->name('reports.index');
    Route::get('{report}', 'ReportController@download')->name('reports.download');
});

