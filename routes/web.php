<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','auth.login');

// Route::get('/nav', function () {
//     return view('layouts.master');
// });
Route::get('/test',function(){
    $pdf =PDF:: loadHTML('<h1>Hello</h1>');
    return $pdf->stream();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//sell
Route::get('/sell', 'SellController@index')->name('sell');
Route::get('/sell/add', 'SellController@create')->name('sell.add');
Route::post('/sell/store', 'SellController@store')->name('sell.store');
Route::get('/sell/individual/{id}', 'SellController@individual')->name('sell.individual');
Route::get('/sell/individual_sell/{id}', 'SellController@individual_sell')->name('sell.individual_sell');
Route::post('/sell/selected_date/{customer_id}', 'SellController@selected_date')->name('sell.selected_date');
Route::get('/sell/edit/{id}', 'SellController@edit')->name('sell.edit');
Route::post('/sell/update/', 'SellController@update')->name('sell.update');
Route::get('/sell/destroy/{id}', 'SellController@destroy')->name('sell.destroy');

// Set Default
Route::get('/default_product', 'DefaultProductController@index')->name('default_products');
Route::get('/default_product/add', 'DefaultProductController@create')->name('default_product.add');
Route::post('/default_product/store', 'DefaultProductController@store')->name('default_product.store');
Route::get('/default_product/edit/{default_id}', 'DefaultProductController@edit')->name('default_product.edit');
Route::post('/default_product/update', 'DefaultProductController@update')->name('default_product.update');
Route::get('/default_product/destroy/{default_id}', 'DefaultProductController@destroy')->name('default_product.destroy');
Route::get('/default_product/{product_id}', 'DefaultProductController@getDefault')->name('default_product.set');


//GST sell
Route::get('/gstsell', 'SellController@gstindex')->name('gst_sell');
Route::get('/gstsell/add', 'SellController@gstcreate')->name('gst_sell.add');
Route::post('/gstsell/store', 'SellController@gststore')->name('gst_sell.store');
Route::get('/gstsell/individual/{id}', 'SellController@gstindividual')->name('gst_sell.individual');
// Route::get('/sell/individual_sell/{id}', 'SellController@individual_sell')->name('sell.individual_sell');
// Route::post('/sell/selected_date/{customer_id}', 'SellController@selected_date')->name('sell.selected_date');

//Payment
Route::get('/sell/payment', 'PaymentController@index')->name('payments');
Route::get('/sell/payment/add', 'PaymentController@create')->name('payment.add');
Route::post('/sell/payment/store', 'PaymentController@store')->name('payment.store');

//customer
Route::get('/customer', 'CustomerController@index')->name('customers');
Route::get('/customer/add', 'CustomerController@create')->name('customer.add');
Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
Route::get('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update/', 'CustomerController@update')->name('customer.update');
Route::get('/customer/destroy/{id}', 'CustomerController@destroy')->name('customer.destroy');
Route::get('/customer/enable/{id}', 'CustomerController@enable')->name('customer.enable');

//Unit
Route::get('/unit', 'UnitController@index')->name('units');
Route::get('/unit/add', 'UnitController@create')->name('unit.add');
Route::post('/unit/store', 'UnitController@store')->name('unit.store');
Route::get('/unit/edit/{id}', 'UnitController@edit')->name('unit.edit');
Route::post('/unit/update', 'UnitController@update')->name('unit.update');
Route::get('/unit/destroy/{id}', 'UnitController@destroy')->name('unit.destroy');
Route::get('/unit/enable/{id}', 'UnitController@enable')->name('unit.enable');

//Categories
Route::get('/category', 'CategoryController@index')->name('categories');
Route::get('/category/add', 'CategoryController@create')->name('category.add');
Route::post('/category/store', 'CategoryController@store')->name('category.store');
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::post('/category/update', 'CategoryController@update')->name('category.update');
Route::get('/category/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
Route::get('/category/enable/{id}', 'CategoryController@enable')->name('category.enable');

//Product
Route::get('/product', 'ProductController@index')->name('products');
Route::get('/product/add', 'ProductController@create')->name('product.add');
Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
Route::get('/product/enable/{id}', 'ProductController@enable')->name('product.enable');

//Inventory
Route::get('/inventories', 'InventoryController@index')->name('inventories');
Route::get('/inventory/add', 'InventoryController@create')->name('inventory.add');
Route::post('/inventory/store', 'InventoryController@store')->name('inventory.store');

//Invoice
Route::get('/invoice', 'InvoiceController@index')->name('invoice');
Route::get('/invoice/view/{bill_id}', 'InvoiceController@view')->name('invoice.view');
Route::get('/invoice/destroy/{bill_id}', 'InvoiceController@destroy')->name('invoice.destroy');
Route::get('/invoice/add', 'InvoiceController@add')->name('invoice.add');
Route::post('/invoice/store', 'InvoiceController@store')->name('invoice.store');

//Purchaser
Route::get('/purchaser', 'PurchaserController@index')->name('purchasers');
Route::get('/purchaser/add', 'PurchaserController@create')->name('purchaser.add');
Route::post('/purchaser/store', 'PurchaserController@store')->name('purchaser.store');
Route::get('/purchaser/edit/{id}', 'PurchaserController@edit')->name('purchaser.edit');
Route::post('/purchaser/update/', 'PurchaserController@update')->name('purchaser.update');
Route::get('/purchaser/destroy/{id}', 'PurchaserController@destroy')->name('purchaser.destroy');
Route::get('/purchaser/enable/{id}', 'PurchaserController@enable')->name('purchaser.enable');


//purchase
Route::get('/purchase', 'PurchaseController@index')->name('purchase');
Route::get('/purchase/add', 'PurchaseController@create')->name('purchase.add');
Route::post('/purchase/store', 'PurchaseController@store')->name('purchase.store');
Route::get('/purchase/individual/{id}', 'PurchaseController@individual')->name('purchase.individual');
// Route::get('/sell/individual_sell/{id}', 'SellController@individual_sell')->name('sell.individual_sell');
// Route::post('/sell/selected_date/{customer_id}', 'SellController@selected_date')->name('sell.selected_date');

//Purchase Payments
Route::get('/purchase/puchase_payment', 'PurchasePaymentController@index')->name('purchase_payments');
Route::get('/purchase/puchase_payment/add', 'PurchasePaymentController@create')->name('purchase_payment.add');
Route::post('/purchase/puchase_payment/store', 'PurchasePaymentController@store')->name('purchase_payment.store');

// Lorry
Route::get('/lorry', 'LorryController@index')->name('lorries');
Route::get('/lorry/add', 'LorryController@create')->name('lorry.add');
Route::post('/lorry/store', 'LorryController@store')->name('lorry.store');
Route::get('/lorry/edit/{id}', 'LorryController@edit')->name('lorry.edit');
Route::post('/lorry/update', 'LorryController@update')->name('lorry.update');
Route::get('/lorry/destroy/{id}', 'LorryController@destroy')->name('lorry.destroy');
Route::get('/lorry/enable/{id}', 'LorryController@enable')->name('lorry.enable');

// Lorry Report
Route::get('/lorry_report', 'LorryReportController@index')->name('lorry_reports');
Route::get('/lorry_report/add', 'LorryReportController@create')->name('lorry_report.add');
Route::post('/lorry_report/store', 'LorryReportController@store')->name('lorry_report.store');

//Admin
Route::get('/admin', 'AdminController@index')->name('admins');
Route::get('/admin/add', 'AdminController@create')->name('admin.add');
Route::post('/admin/store', 'AdminController@store')->name('admin.store');
Route::get('/admin/edit/{id}', 'AdminController@edit')->name('admin.edit');
Route::post('/admin/update', 'AdminController@update')->name('admin.update');
Route::get('/admin/destroy/{id}', 'AdminController@destroy')->name('admin.destroy');
Route::get('/admin/enable/{id}', 'AdminController@enable')->name('admin.enable');

