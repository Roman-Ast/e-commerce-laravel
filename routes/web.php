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

Route::post('/saveAsDraft', 'ArticleController@saveAsDraft')->name('articles.saveAsDraft');
Route::patch('/updateDraft', 'ArticleController@updateDraft')->name('articles.updateDraft');
Route::patch('/article/like', 'ArticleController@like')->name('article.like');
Route::get('/myarticles', 'ArticleController@myArticles')->name('articles.myarticles');
Route::resource('/products', 'ProductController');
Route::resource('/articles', 'ArticleController');
Route::resource('/comments', 'CommentController');
Route::resource('/subcomments', 'SubCommentController');
Route::resource('/checkout', 'CheckoutController');
Route::resource('/products', 'ProductController');
Route::resource('/reviews', 'ReviewController');
Route::resource('/cart', 'CartController');
Route::resource('/wishlist', 'WishListController');

Route::get('/about', 'MainPageController@about')->name('about');
Route::get('/thankyou', 'PaymentConfirmationController@index')->name('paymentconfirmation.index');
Route::get('/wishlistclear', 'WishListController@clear')->name('wishlist.clear');
Route::get('/cartclear', 'CartController@clear')->name('cart.clear');
Route::post('/cart/switchToSaveForLater/{id}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::get('/filter', 'ProductController@filter');
Route::post('/products', 'ProductController@filter')->name('products.filter');

Auth::routes();
Route::get('/', 'MainPageController@index')->name('main');
Route::get('/home', 'MainPageController@index')->name('home');
Route::get('/search', 'ProductController@search')->name('search');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
