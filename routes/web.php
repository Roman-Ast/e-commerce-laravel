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

/*Route::get('/', function () {
    return view('home');
});*/

Route::post('/showProducts/{productType}', 'ProductsController@filter');
Route::get('/showProducts/{productType}', 'ProductsController@show');
Route::get('/showProducts/{productType}/{id}', 'ProductController@show');





Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
