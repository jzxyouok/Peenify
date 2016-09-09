<?php

namespace App;

use App\Extensions\FollowableTrait;
use App\Extensions\syncFollowToUser;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use FollowableTrait;

    protected $table = 'categories';

    protected $fillable = [
      'name', 'description', 'status', 'user_id', 'cover'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
