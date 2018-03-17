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
//Route::get('/main', 'HomeController@index')->name('main');
Route::view('/main', 'stockinfo')->name('main');

Route::get('/', 'Auth\LoginController@show');

//Product
Route::get('/product/add', 'ProductController@add')->name('product.add');
Route::post('/getSizeByType', 'ProductController@getSizeByType')->name('getSizeByType');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/insert', 'ProductController@insert')->name('product.insert');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
Route::get('/product/allProduct', 'ProductController@allProduct')->name('product.list');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::post('/getProductByCategory', 'ProductController@getProductByCategory')->name('getProductByCategory');
Route::post('/getProductPrice', 'ProductController@getProductPrice')->name('getProductPrice');

Route::post('/product/ProductList', 'ProductController@ProductList')->name('product.data');

Route::post('/product/csvExport', 'ProductController@csvExport')->name('product.csv');


//Route::get('Product', 'ProductController', [
//    'anyData'  => 'product.data',
//    'allProduct' => 'product.list',
//]);

//Generate Product
//Route::get('/product/generate', 'ProductController@generate')->name('generate.file');


//offer
Route::get('/offer/add', 'OfferController@add')->name('offer.add');
Route::post('/offer/add', 'OfferController@insert')->name('offer.insert');
Route::get('/offer/generate', 'OfferController@index')->name('offer.generate');
Route::get('/offer/bulkOffer', 'OfferController@BulkOffer')->name('offer.bulkOffer');
Route::post('/offer/bulkOfferdt', 'OfferController@BulkOfferdt')->name('offer.bulkOfferdt');


//Route::view('/offer/generate', 'offer.generate')->name('offer.generate');
Route::post('/offer/getOfferList', 'OfferController@getOfferList')->name('offer.offerList');
Route::post('/offer/update', 'OfferController@update')->name('offer.update');
Route::get('/offer/edit/{id}', 'OfferController@edit')->name('offer.edit');
Route::get('/offer/delete/{id}', 'OfferController@destroy')->name('offer.delete');

Route::post('/offer/csvExport', 'OfferController@csvExport')->name('offer.csv');

//setting
Route::get('/historic/files', 'HistoryController@index')->name('historic.files');
Route::post('/historic/files', 'HistoryController@getHistoryData')->name('history.data');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/getColor', 'SettingsController@getColors')->name('settings.getColors');
Route::post('/settings/colorajax', 'SettingsController@colorAjax')->name('settings.colorajax');
Route::post('/settings/categoryajax', 'SettingsController@categoryAjax')->name('settings.categoryajax');
Route::post('/settings/careajax', 'SettingsController@careAjax')->name('settings.careajax');
Route::post('/settings/sizeajax', 'SettingsController@sizeAjax')->name('settings.sizeajax');
Route::post('/settings/runtosizeajax', 'SettingsController@runtosizeAjax')->name('settings.runtosizeajax');
Route::post('/settings/season', 'SettingsController@season')->name('settings.season');


// insert setting
Route::view('/settings/addCare', 'settings.insertcare')->name('settings.addcare');
Route::post('/settings/insertCare', 'SettingsController@insertCare')->name('settings.insertCare');
Route::view('/settings/addCategory', 'settings.insertcategory')->name('settings.addcategory');
Route::post('/settings/addSize', 'SettingsController@addSize')->name('settings.addsize');
Route::post('/settings/insertCategory', 'SettingsController@insertCategory')->name('settings.insertCategory');
Route::view('/settings/addColor', 'settings.insertcolor')->name('settings.addcolor');
Route::post('/settings/insertColor', 'SettingsController@insertColor')->name('settings.insertColor');
Route::view('/settings/addRuntosize', 'settings.insertruntosize')->name('settings.addruntosize');
Route::post('/settings/insertRunToSize', 'SettingsController@insertRunToSize')->name('settings.insertRunToSize');
Route::post('/settings/insertSize', 'SettingsController@insertSize')->name('settings.insertSize');

//Edit Settings
Route::get('edit/category/{id}','SettingsController@editCategory')->name('edit.category');
Route::get('edit/color/{id}','SettingsController@editColor')->name('edit.color');
Route::get('edit/size/{id}','SettingsController@editSize')->name('edit.size');
Route::get('edit/care/{id}','SettingsController@editCare')->name('edit.care');
Route::get('edit/runtosize/{id}','SettingsController@editRunToSize')->name('edit.runToSize');

//Update Settings

Route::post('edit/category','SettingsController@updateCategory')->name('update.category');
Route::post('edit/color','SettingsController@updateColor')->name('update.color');
Route::post('edit/care','SettingsController@updateCare')->name('update.care');
Route::post('edit/size','SettingsController@updateSize')->name('update.size');
Route::post('edit/runtosize','SettingsController@updateRunToSize')->name('update.runToSize');


Route::post('update/category','SettingsController@updateCategory')->name('update.category');
Route::post('update/color','SettingsController@updateColor')->name('update.color');
Route::post('update/care','SettingsController@updateCare')->name('update.care');
Route::post('update/size','SettingsController@updateSize')->name('update.size');
Route::post('update/runtosize','SettingsController@updateRunToSize')->name('update.runToSize');

//stockinfo
Route::view('/stockinfo', 'stockinfo')->name('stockinfo');
Route::post('/stockinfo/showinfo', 'StockController@Showinfo')->name('stockinfo.showinfo');


//Delete Settings
Route::get('delete/size/{id}','SettingsController@destroySize')->name('size.destroy');
Route::get('delete/category/{id}','SettingsController@destroyCategory')->name('category.destroy');
Route::get('delete/care/{id}','SettingsController@destroyCare')->name('care.destroy');
Route::get('delete/color/{id}','SettingsController@destroyColor')->name('color.destroy');
Route::get('delete/runtosize/{id}','SettingsController@destroyRunToSize')->name('runtosize.destroy');


//Route::get('/dashboard', 'HomeController@index')->name('home');

//Route::get('/home',function (){
//    return redirect('/dashboard');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/sendftp', 'ProductController@sendftp')->name('sendftp');

