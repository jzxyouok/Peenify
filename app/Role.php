<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
      'name', 'label', 'user_id'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    public function syncPermissionsTo($permissions)
    {
        return $this->permissions()->sync((array) $permissions);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
