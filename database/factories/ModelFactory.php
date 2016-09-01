<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'name' => 'movies',
        'description' => 'this is movie',
        'status' => 1
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'category_id' => factory(App\Category::class)->create(),
        'name' => 'diablo3',
        'description' => 'dead',
        'status' => 1
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'commentable_type' => 'product',
        'commentable_id' => factory(\App\Product::class)->create(),
        'description' => 12345,
    ];
});

$factory->define(App\Collection::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create(),
        'name' => 'my collection',
        'description' => 'this is a game',
        'status' => 1
    ];
});
