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

        foreach ($categories as $category) {
            \App\Category::create([
                'user_id' => 1,
                'name' => $category,
                'description' => '最新最熱門的' . $category . '情報與評論。',
            ]);
        }
    }
}
