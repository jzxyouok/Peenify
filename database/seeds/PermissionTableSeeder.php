<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('permission') as $permission => $value) {
            factory(\App\Permission::class)->create([
                'name' => $permission,
                'label' => $value,
            ]);
        }
    }
}
