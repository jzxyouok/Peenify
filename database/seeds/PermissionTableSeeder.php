<?php

use App\Role;
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
        DB::table('permissions')->truncate();

        foreach (config('permission') as $permission => $value) {
            factory(\App\Permission::class)->create([
                'name' => $permission,
                'label' => $value['description'],
                'user_id' => 1
            ]);
        }

        //all can access
        Role::find(config('role.Administrator.id'))->syncPermissionsTo([config('permission.backend.id'), config('permission.all.id')]);

        //user can access
        Role::find(config('role.Beta - Elite.id'))->syncPermissionsTo([config('permission.basic.id')]);
        Role::find(config('role.Elite.id'))->syncPermissionsTo([config('permission.basic.id')]);
        Role::find(config('role.Basic.id'))->syncPermissionsTo([config('permission.basic.id')]);
        Role::find(config('role.Premium.id'))->syncPermissionsTo([config('permission.basic.id')]);
    }
}
