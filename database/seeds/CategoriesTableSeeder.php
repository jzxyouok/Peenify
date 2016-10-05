<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = ['電影', '劇集', '動畫', '遊戲'];
        $user = factory(\App\User::class)->create();

        foreach ($categories as $category) {
            \App\Category::create([
                'user_id' => $user->id,
                'name' => $category,
                'description' => $category . '分類',
            ]);
        }
    }
}
