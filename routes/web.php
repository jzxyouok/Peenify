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

        Route::get('{user}/wishlist', [
            'as' => 'wishes.user',
            'uses' => 'WishesController@showByUser'
        ]);

        Route::post('wishes/{product}', [
            'as' => 'wishes.sync',
            'uses' => 'WishesController@sync'
        ]);
    });

    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UsersController@index',
    ]);

    Route::get('{user}/emojis', [
        'as' => 'users.emojis',
        'uses' => 'EmojisController@showByUser'
    ]);

    Route::get('{user}/follows', [
        'as' => 'users.follows',
        'uses' => 'FollowsController@showByUser'
    ]);

    Route::get('{user}', [
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

        Route::get('{category}/products', [
            'as' => 'categories.products',
            'uses' => 'CategoriesController@products',
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

    Route::get('{category}', [
        'as' => 'categories.show',
        'uses' => 'CategoriesController@show',
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
        Route::post('{commentable_type}/{commentable_id}', [
            'as' => 'comments.store',
            'uses' => 'CommentsController@store',
        ]);

        Route::get('{comment}/edit', [
            'as' => 'comments.edit',
            'uses' => 'CommentsController@edit',
        ]);

        Route::match(['PUT', 'PATCH'], '{comment}', [
            'as' => 'comments.update',
            'uses' => 'CommentsController@update',
        ]);

        Route::delete('{comment}', [
            'as' => 'comments.destroy',
            'uses' => 'CommentsController@destroy',
        ]);
    });
});

Route::resource('collections', 'CollectionsController');
Route::post('collections/addProduct/{product}', [
    'as' => 'collections.addProduct',
    'uses' => 'CollectionsController@addProduct',
]);


Route::group(['middleware' => 'auth'], function () {
    Route::post('emojis/{emojiable_type}/{emojiable_id}', [
        'as' => 'emojis.sync',
        'uses' => 'EmojisController@sync',
    ]);

    Route::post('follows/{followable_type}/{followable_id}', [
        'as' => 'follows.sync',
        'uses' => 'FollowsController@sync',
    ]);

    Route::get('/api/tags/ajaxTags', [
        'as' => 'tags.term',
        'uses' => 'TagsController@ajaxTags',
    ]);
});

Route::resource('authors', 'AuthorsController');
Route::resource('actors', 'ActorsController');
Route::resource('vendors', 'VendorsController');
Route::group(['prefix' => 'tags'], function () {
    Route::get('/', [
        'as' => 'tags.index',
        'uses' => 'TagsController@index',
    ]);

    Route::get('{tag}', [
        'as' => 'tags.show',
        'uses' => 'TagsController@show',
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'backend.auth']], function () {
    Route::get('/', [
        'as' => 'backend.index',
        'uses' => 'Backend\HomeController@index',
    ]);

    Route::get('products', [
        'as' => 'backend.product',
        'uses' => 'Backend\HomeController@product',
    ]);
});