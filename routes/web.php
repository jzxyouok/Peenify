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

    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UsersController@index',
    ]);

    Route::get('{id}', [
        'as' => 'users.show',
        'uses' => 'UsersController@show',
    ]);
});

Route::group(['prefix' => 'categories'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [
            'as' => 'categories.create',
            'uses' => 'CategoriesController@create',
        ]);

        Route::post('/', [
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

    Route::get('/', [
        'as' => 'categories.index',
        'uses' => 'CategoriesController@index',
    ]);
});

Route::group(['prefix' => 'products'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [
            'as' => 'products.create',
            'uses' => 'ProductsController@create',
        ]);

        Route::post('/', [
            'as' => 'products.store',
            'uses' => 'ProductsController@store',
        ]);

        Route::match(['PUT', 'PATCH'], '{product}', [
            'as' => 'products.update',
            'uses' => 'ProductsController@update',
        ]);

        Route::get('{product}/edit', [
            'as' => 'products.edit',
            'uses' => 'ProductsController@edit',
        ]);

        Route::delete('{product}', [
            'as' => 'products.destroy',
            'uses' => 'ProductsController@destroy',
        ]);
    });

    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'ProductsController@index',
    ]);

    Route::get('{product}', [
        'as' => 'products.show',
        'uses' => 'ProductsController@show',
    ]);
});

Route::group(['prefix' => 'comments'], function () {
    //login 才能看留言
    Route::group(['middleware' => 'auth'], function () {
        Route::post('{product}', [
            'as' => 'comments.store',
            'uses' => 'CommentsController@store',
        ]);
    });
});

//Route::resource('comments', 'CommentsController');

Route::resource('collections', 'CollectionsController'); //relations with product
Route::resource('wishlists', 'WishlistsController'); //relations with product

Auth::routes();

Route::get('/home', 'HomeController@index');
