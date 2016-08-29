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

    Route::group(['middleware' => 'auth'], function () {
        Route::get('edit', [
            'as' => 'users.edit',
            'uses' => 'UsersController@edit',
        ]);
        Route::match(['PUT', 'PATCH'], 'update', [
            'as' => 'users.update',
            'uses' => 'UsersController@update',
        ]);
    });

    Route::get('{id}', [
        'as' => 'users.show',
        'uses' => 'UsersController@show',
    ]);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [
        'as' => 'categories.index',
        'uses' => 'CategoriesController@index',
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [
            'as' => 'categories.create',
            'uses' => 'CategoriesController@create',
        ]);

        Route::post('store', [
            'as' => 'categories.store',
            'uses' => 'CategoriesController@store',
        ]);

        Route::get('{category}', [
            'as' => 'categories.show',
            'uses' => 'CategoriesController@show',
        ]);

        Route::match(['PUT', 'PATCH'], '{category}', [
            'as' => 'categories.update',
            'uses' => 'CategoriesController@update',
        ]);

        Route::get('{category}/edit', [
            'as' => 'categories.edit',
            'uses' => 'CategoriesController@edit',
        ]);

        Route::delete('{category}', [
            'as' => 'categories.destroy',
            'uses' => 'CategoriesController@destroy',
        ]);
    });
});
//Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('comments', 'CommentsController');

Route::resource('collections', 'CollectionsController'); //relations with product
Route::resource('wishlists', 'WishlistsController'); //relations with product

Auth::routes();

Route::get('/home', 'HomeController@index');
