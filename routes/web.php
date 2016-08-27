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

Route::group(['prefix' => 'users'], function () {
    Route::get('index', [
        'as' => 'users.index',
        'uses' => 'UsersController@index',
    ]);

    Route::match(['PUT', 'PATCH'], '{id}', [
        'as' => 'users.update',
        'uses' => 'UsersController@update',
    ]);

    Route::get('{id}/edit', [
        'as' => 'users.edit',
        'uses' => 'UsersController@edit',
    ]);

    Route::get('{id}', [
        'as' => 'users.show',
        'uses' => 'UsersController@show',
    ]);
});

Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('comments', 'CommentsController');

Route::resource('collections', 'CollectionsController');
Route::resource('wishlists', 'WishlistsController');

Auth::routes();

Route::get('/home', 'HomeController@index');
