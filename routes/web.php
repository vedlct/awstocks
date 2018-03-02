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

//HOme
Route::get('/main', 'HomeController@index')->name('main');
Route::get('/', 'Auth\LoginController@show');

//Product
Route::get('/product/add', 'ProductController@add')->name('product.add');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/insert', 'ProductController@insert')->name('product.insert');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');

Route::get('/product/allProduct', 'ProductController@allProduct')->name('product.list');

Route::post('/product/update', 'ProductController@update')->name('product.update');

Route::post('/product/ProductList', 'ProductController@ProductList')->name('product.data');

Route::post('/product/csvExport', 'ProductController@csvExport')->name('product.csv');


//Route::get('Product', 'ProductController', [
//    'anyData'  => 'product.data',
//    'allProduct' => 'product.list',
//]);

//Generate Product
//Route::get('/product/generate', 'ProductController@generate')->name('generate.file');


//offer
Route::view('/offer/add', 'offer.add')->name('offer.add');

Route::get('/offer/generate', 'OfferController@index')->name('offer.generate');
//Route::view('/offer/generate', 'offer.generate')->name('offer.generate');
Route::post('/offer/getOfferList', 'OfferController@getOfferList')->name('offer.offerList');
Route::post('/offer/editoffer', 'OfferController@editoffer')->name('offer.editoffer');

//setting
Route::view('/historic/files', 'layouts.starLeads')->name('historic.files');
Route::view('/settings', 'layouts.newInfo')->name('settings');




//Route::get('/dashboard', 'HomeController@index')->name('home');

//Route::get('/home',function (){
//    return redirect('/dashboard');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
