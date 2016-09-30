<?php

namespace App;

use App\Foundation\Followable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Followable;

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
