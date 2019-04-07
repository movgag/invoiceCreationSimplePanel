<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/invoices', 'HomeController@dashboard')->name('home');
Route::match(['GET','POST'],'/invoices/add', 'HomeController@add')->name('invoices.add');
Route::get('/invoices/delete/{id}', 'HomeController@delete')->name('invoice.delete');
Route::match(['GET','POST'],'/invoices/edit/{id}', 'HomeController@edit')->name('invoice.edit');
Route::get('/invoices/view/{id}', 'HomeController@view')->name('invoice.view');
Route::post('/get-product-info','HomeController@getProductInfoAjax')->name('get.product.info.ajax');
