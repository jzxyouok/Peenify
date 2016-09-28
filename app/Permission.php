<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['name', 'label', 'user_id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
