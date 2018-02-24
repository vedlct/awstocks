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


Route::get('/main', 'HomeController@index')->name('main');
Route::get('/', 'Auth\LoginController@show');
Route::view('/product/add', 'layouts.myList')->name('product.add');
Route::view('/generate/file', 'layouts.testList')->name('generate.file');
Route::view('/offer/add', 'layouts.clients')->name('offer.add');


Route::view('/offer/generate', 'layouts.leads')->name('offer.generate');
Route::view('/historic/files', 'layouts.starLeads')->name('historic.files');
Route::view('/settings', 'layouts.newInfo')->name('settings');




//Route::get('/dashboard', 'HomeController@index')->name('home');

//Route::get('/home',function (){
//    return redirect('/dashboard');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
