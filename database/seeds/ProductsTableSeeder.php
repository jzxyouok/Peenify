<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('users')->truncate();
        DB::table('tags')->truncate();
        DB::table('tagged')->truncate();

        $categories = \App\Category::all();
        $faker = Faker::create();
        $user = factory(\App\User::class)->create();

        foreach ($categories as $category) {
            for ($i = 1; $i <= random_int(1, 20); $i++) {
                $product = \App\Product::create([
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                    'name' => $faker->company,
                    'description' => $faker->sentence,
                ]);

                $product->tag([$faker->text(random_int(5, 10)), $faker->text(random_int(5, 10)), $faker->text(random_int(5, 10))]);
            }
        }
    }
}
