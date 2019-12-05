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
Route::resource('/reviews', 'ReviewController');
Route::get('/showProducts/{productType}', 'ProductsController@show');
Route::post('/showProducts/{productType}', 'ProductsController@filter');


Route::get('/showProducts/filter/{productType}', 'ProductsController@filter');
Route::get('/showProducts/{productType}/{id}', 'ProductController@show');
Route::get('/showProducts/filter/{productType}/{id}', 'ProductController@show');







Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

