<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Role::class)->create();
        factory(\App\Role::class)->create([
            'name' => 'Elite',
            'description' => '菁英'
        ]);

        factory(\App\Role::class)->create([
            'name' => 'Beta - Elite',
            'description' => '內測菁英'
        ]);

        factory(\App\Role::class)->create([
            'name' => 'Normal',
            'description' => '一般會員'
        ]);
    }
}
