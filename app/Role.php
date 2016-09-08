<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id', 'name', 'description', 'status',
    ];

    /**
     * 屬於該身份的使用者
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
