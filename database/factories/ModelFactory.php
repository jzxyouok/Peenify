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
        'user_id' => factory(App\User::class)->create()->id,
        'name' => 'movies',
        'description' => 'this is movie',
        'status' => 1
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'category_id' => factory(App\Category::class)->create()->id,
        'name' => 'diablo3',
        'description' => 'dead',
        'status' => 1
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'commentable_type' => 'product',
        'commentable_id' => factory(\App\Product::class)->create()->id,
        'description' => 12345,
    ];
});

$factory->define(App\Collection::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => 'my collection',
        'description' => 'this is a game',
        'status' => 1
    ];
});

$factory->define(App\Wish::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'product_id' => factory(App\Product::class)->create()->id,
    ];
});

$factory->define(App\Follow::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'followable_type' => 'category',
        'followable_id' => factory(\App\Category::class)->create()->id,
    ];
});

$factory->define(App\Vendor::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => '福斯',
        'description' => '21世紀炸雞',
        'agent' => '我是代理商',
    ];
});

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => '拉拉雅拉伯汗',
        'description' => '我拍過鋼鐵人我超厲害的',
        'gender' => 'male',
        'country' => 'TW',
    ];
});

$factory->define(App\Actor::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => '李奧納多皮卡丘',
        'description' => '我拍過鐵達尼號',
        'gender' => 'male',
        'country' => 'US',
    ];
});
