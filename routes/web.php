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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//sell
Route::get('/sell', 'SellController@index')->name('sell');
Route::get('/sell/add', 'SellController@create')->name('sell.add');
Route::post('/sell/store', 'SellController@store')->name('sell.store');
Route::get('/sell/individual/{id}', 'SellController@individual')->name('sell.individual');
Route::get('/sell/individual_sell/{id}', 'SellController@individual_sell')->name('sell.individual_sell');
Route::post('/sell/selected_date/{customer_id}', 'SellController@selected_date')->name('sell.selected_date');

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
Route::get('/invoice/add', 'InvoiceController@add')->name('invoice.add');
Route::post('/invoice/invoice', 'InvoiceController@invoice')->name('invoice.invoice');




