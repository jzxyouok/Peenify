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
        DB::table('roles')->truncate();

        foreach (config('role') as $role => $value) {
            factory(\App\Role::class)->create([
                'name' => $role,
                'label' => $value['label'],
                'user_id' => 1,
            ]);
        }
    }
}
