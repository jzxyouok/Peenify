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
        'name' => 'movies',
        'description' => 'this is movie',
        'status' => 1
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => 'diablo3',
        'description' => 'dead',
        'status' => 1
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'description' => 12345,
    ];
});

$factory->define(App\Collection::class, function (Faker\Generator $faker) {
    return [
        'name' => 'my collection',
        'description' => 'this is a game',
        'status' => 1
    ];
});

$factory->define(App\Wishlist::class, function (Faker\Generator $faker) {
    return [
        'name' => 'my wishlist',
        'description' => 'this is a game',
        'status' => 1
    ];
});
