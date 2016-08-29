<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id', 'name', 'description', 'status', 'cover', 'user_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
