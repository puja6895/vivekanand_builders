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



