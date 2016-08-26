<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * Facebook login
 */
Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('comments', 'CommentsController');

Route::resource('collections', 'CollectionsController');
Route::resource('wishlists', 'WishlistsController');

Auth::routes();

Route::get('/home', 'HomeController@index');
