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

/*
 * 歡迎頁面
 */
Route::get('/', function () {
    return view('welcome');
});

/*
 * 搜尋功能
 * @test case: done
 */
Route::group(['prefix' => 'searches'], function () {

    //產品
    Route::get('result', [
        'as' => 'searches.products.result',
        'uses' => 'Search\Product\ResultName'
    ]);

    //收藏集
    Route::get('collections/result', [
        'as' => 'searches.collections.result',
        'uses' => 'Search\Collection\ResultName'
    ]);

    //要將產品加入收藏集的搜尋列
    Route::get('collection/product/result/{collection}', [
        'as' => 'searches.collection.product.result',
        'uses' => 'Search\Collection\ProductList'
    ]);
});


/*
 * Facebook 登入回呼跟寫入服務
 * @test case: done
 */
Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

/*
 * User 可操作功能
 * @test case:
 */
Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => 'auth'], function () {
        /*
         * 編輯個人資料
         * @test:done
         */
        Route::get('edit', [
            'as' => 'users.edit',
            'uses' => 'UsersController@edit',
        ]);

        /*
         * 更新個人資料
         * @test:done
         */
        Route::match(['PUT', 'PATCH'], 'update', [
            'as' => 'users.update',
            'uses' => 'UsersController@update',
        ]);
    });

    /*
     * User 評分清單
     * @test:done
     */
    Route::get('{user}/emojis', [
        'as' => 'users.emojis',
        'uses' => 'User\ShowEmojis'
    ]);

    /*
     * User 書籤清單
     * @test:done
     */
    Route::get('{user}/bookmarks', [
        'as' => 'users.bookmarks',
        'uses' => 'User\ShowBookmarks'
    ]);

    /*
     * User 最愛清單
     * @test:done
     */
    Route::get('{user}/favorites', [
        'as' => 'users.favorites',
        'uses' => 'User\ShowFavorites'
    ]);

    /*
     * User 收藏清單
     * @test:done
     */
    Route::get('{user}/collections', [
        'as' => 'users.collections',
        'uses' => 'User\ShowCollections'
    ]);

    /*
     * User 個人資料
     * @test:done
     */
    Route::get('{user}', [
        'as' => 'users.show',
        'uses' => 'UsersController@show',
    ]);
});

/*
 * Category 類別 可操作功能
 * ex: 電影／遊戲／旅遊／餐廳／文具／．．．．
 */
Route::group(['prefix' => 'categories'], function () {
    Route::group(['middleware' => ['auth', 'auth.backend']], function () {
        /*
         * 建立類別
         */
        Route::get('create', [
            'as' => 'categories.create',
            'uses' => 'CategoriesController@create',
        ]);

        /*
         * 儲存建立類別
         */
        Route::post('/', [
            'as' => 'categories.store',
            'uses' => 'CategoriesController@store',
        ]);

        /*
         * 編輯類別
         */
        Route::match(['PUT', 'PATCH'], '{category}', [
            'as' => 'categories.update',
            'uses' => 'CategoriesController@update',
        ]);

        /*
         * 更新類別
         */
        Route::get('{category}/edit', [
            'as' => 'categories.edit',
            'uses' => 'CategoriesController@edit',
        ]);

        /*
         * 刪除類別
         */
        Route::delete('{category}', [
            'as' => 'categories.destroy',
            'uses' => 'CategoriesController@destroy',
        ]);
    });

    /*
     * 取得分類下的所有產品
     */
    Route::get('{category}/products', [
        'as' => 'categories.products',
        'uses' => 'CategoriesController@products',
    ]);

    /*
     * 類別清單
     */
    Route::get('/', [
        'as' => 'categories.index',
        'uses' => 'CategoriesController@index',
    ]);

    /*
     * 類別頁面
     */
    Route::get('{category}', [
        'as' => 'categories.show',
        'uses' => 'CategoriesController@show',
    ]);
});

/*
 * 產品可操作功能
 */
Route::group(['prefix' => 'products'], function () {
    Route::group(['middleware' => ['auth', 'auth.backend']], function () {
        /*
         * 建立產品
         */
        Route::get('create', [
            'as' => 'products.create',
            'uses' => 'ProductsController@create',
        ]);

        /*
         * 儲存建立產品
         */
        Route::post('/', [
            'as' => 'products.store',
            'uses' => 'ProductsController@store',
        ]);

        /*
         * 編輯產品
         */
        Route::get('{product}/edit', [
            'as' => 'products.edit',
            'uses' => 'ProductsController@edit',
        ]);

        /*
         * 更新產品
         */
        Route::match(['PUT', 'PATCH'], '{product}', [
            'as' => 'products.update',
            'uses' => 'ProductsController@update',
        ]);

        /*
         * 刪除產品
         */
        Route::delete('{product}', [
            'as' => 'products.destroy',
            'uses' => 'ProductsController@destroy',
        ]);
    });

    /*
     * 所有產品清單
     */
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'ProductsController@index',
    ]);

    /*
     * 產品頁面
     */
    Route::get('{product}', [
        'as' => 'products.show',
        'uses' => 'ProductsController@show',
    ]);
});

/*
 * Comment 評論 可操作功能
 */
Route::group(['prefix' => 'comments'], function () {
    Route::group(['middleware' => 'auth'], function () {
        /*
         * 儲存建立評論
         */
        Route::post('{product_id}', [
            'as' => 'comments.store',
            'uses' => 'CommentsController@store',
        ]);

        /**
         * 擁有者可以編輯與更新自己的評論
         */
        /*
         * 編輯評論
         */
        Route::get('{comment}/edit', [
            'as' => 'comments.edit',
            'uses' => 'CommentsController@edit',
        ]);

        /*
         * 更新評論
         */
        Route::match(['PUT', 'PATCH'], '{comment}', [
            'as' => 'comments.update',
            'uses' => 'CommentsController@update',
        ]);

    });
});

/*
 * 收藏集 CURD
 * TODO clear
 * User
 */
Route::resource('collections', 'CollectionsController');

Route::get('collections/confirm/destroy/{collection}', [
    'as' => 'collections.confirm.destroy',
    'uses' => 'Collection\ConfirmDestroy'
]);

/*
 * 訂閱
 */
Route::group(['middleware' => 'auth'], function() {
    /*
     * 跟隨者
     */
    Route::get('{type}/{id}/subscribers', [
        'as' => 'subscribes.subscribers',
        'uses' => 'Subscribe\ShowSubscriber'
    ]);

    /*
     * 正在訂閱
     */
    Route::get('{type}/{id}/subscribed', [
        'as' => 'subscribes.subscribed',
        'uses' => 'Subscribe\ShowSubscribed'
    ]);
});


Route::group(['middleware' => 'auth'], function() {
    /*
     * 訂閱
     */
    Route::post('subscribes/{type}/{id}', [
        'as' => 'subscribes.sync',
        'uses' => 'SubscribesController@sync',
    ]);

    /*
     * 書籤功能
     */
    Route::post('bookmarks/{type}/{id}', [
        'as' => 'bookmarks.sync',
        'uses' => 'BookmarksController@sync',
    ]);

    /*
     * 評分功能
     */
    Route::post('emojis/{type}/{id}', [
        'as' => 'emojis.sync',
        'uses' => 'EmojisController@sync',
    ]);

    /*
     * 最愛功能
     */
    Route::post('favorites/{type}/{id}', [
        'as' => 'favorites.sync',
        'uses' => 'FavoritesController@sync',
    ]);

    /*
     * 標籤 auto complete api 接口
     */
    Route::get('/api/tags/ajaxTags', [
        'as' => 'tags.term',
        'uses' => 'TagsController@ajaxTags',
    ]);

    /*
     * 將產品加入到自訂的收藏集內
     */
    Route::post('collections/{collection}/product/{product}', [
        'as' => 'collections.product',
        'uses' => 'Collection\SyncProduct',
    ]);
});

/*
 * Tag 標籤 可操作功能
 */
Route::group(['prefix' => 'tags'], function () {
    /*
     * 所有標籤清單
     */
    Route::get('/', [
        'as' => 'tags.index',
        'uses' => 'TagsController@index',
    ]);

    /*
     * 標籤頁面
     */
    Route::get('{tag}', [
        'as' => 'tags.show',
        'uses' => 'TagsController@show',
    ]);
});

/*
 * 登入/註冊／忘記密碼 功能 Laravel make:auth
 */
Auth::routes();

/*
 * 登錄頁面
 */
Route::get('/home', 'HomeController@index');

/*
 * Backend 後台可操作功能
 */
Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'auth.backend']], function () {
    /*
     * 後台登錄頁面
     */
    Route::get('/', [
        'as' => 'backend.index',
        'uses' => 'Backend\HomeController@index',
    ]);

    Route::resource('permissions', 'Backend\PermissionsController');
    Route::resource('roles', 'Backend\RolesController');

    /*
     * 所有分類頁面
     */
    Route::get('categories', [
        'as' => 'backend.categories',
        'uses' => 'Backend\HomeController@categories',
    ]);

    /*
     * 所有產品頁面
     */
    Route::get('products', [
        'as' => 'backend.products',
        'uses' => 'Backend\HomeController@products',
    ]);

    /*
     * 所有標籤頁面
     */
    Route::get('tags', [
        'as' => 'backend.tags',
        'uses' => 'Backend\HomeController@tags',
    ]);

    /*
     * 所有收藏集頁面
     */
    Route::get('collections', [
        'as' => 'backend.collections',
        'uses' => 'Backend\HomeController@collections',
    ]);

    /*
     * 所有 User 頁面
     */
    Route::get('users', [
        'as' => 'backend.users',
        'uses' => 'Backend\HomeController@users',
    ]);

    /*
     * 所有 Article 頁面
     */
    Route::get('articles', [
        'as' => 'backend.articles',
        'uses' => 'Backend\HomeController@articles',
    ]);

    /*
     * 刪除評論
     */
    Route::delete('{comment}', [
        'as' => 'comments.destroy',
        'uses' => 'CommentsController@destroy',
    ]);
});