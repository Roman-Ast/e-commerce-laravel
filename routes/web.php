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
/*Route::post('/cart/update/{id}', function(Request $request, Response $response) {
    $userId = \Auth::user()->id;
    \Cart::session($userId)->update($id, array('quantity' => 3));
    return response()->json($request); 
});*/
Route::resource('/products', 'ProductController');
Route::resource('/reviews', 'ReviewController');
Route::resource('/cart', 'CartController');
Route::resource('/wishlist', 'WishListController');
Route::get('/showProducts/{productType}', 'ProductsController@show');

Route::get('/wishlistclear', 'WishListController@clear')->name('wishlist.clear');
Route::get('/cartclear', 'CartController@clear')->name('cart.clear');
Route::post('/cart/switchToSaveForLater/{id}', 'CartController@switchToSaveForLater')
    ->name('cart.switchToSaveForLater');

Route::post('/showProducts/{productType}', 'ProductsController@filter');


//4yTlTDKu3oJOfzD







Auth::routes();
Route::get('/', 'HomeController@main');
Route::get('/home', 'HomeController@index')->name('home');

