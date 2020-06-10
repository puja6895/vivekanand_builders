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




