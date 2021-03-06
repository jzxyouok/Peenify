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
        'product_id' => factory(\App\Product::class)->create()->id,
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

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'namespace' => 'product',
        'slug' => base64_encode($faker->name)
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Admin',
        'label' => 'Administrator',
        'user_id' => 1,
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => 'edit_all',
        'label' => 'it can edit all.',
        'user_id' => 1,
    ];
});

/*
 * Relations Foundation.
 */

$factory->define(App\Emoji::class, function () {
    return [
        'emojiable_id' => factory(App\Product::class)->create()->id,
        'emojiable_type' => 'product',
        'user_id' => factory(App\User::class)->create()->id,
        'type' => 'like',
    ];
});

$factory->define(App\Bookmark::class, function () {
    return [
        'bookmarkable_id' => factory(App\Product::class)->create()->id,
        'bookmarkable_type' => 'product',
        'user_id' => factory(App\User::class)->create()->id,
    ];
});

$factory->define(App\Favorite::class, function () {
    return [
        'favorable_id' => factory(App\Product::class)->create()->id,
        'favorable_type' => 'product',
        'user_id' => factory(App\User::class)->create()->id,
    ];
});
