<?php

namespace App\Providers;

use App\Category;
use App\Collection;
use App\Comment;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'category' => Category::class,
            'product' => Product::class,
            'comment' => Comment::class,
            'user' => User::class,
            'collection' => Collection::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale(config('app.locale'));

        if($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
    }
}
