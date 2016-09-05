<?php

namespace App;

use App\Extensions\EmojiableTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use EmojiableTrait;

    protected $table = 'products';

    protected $fillable = [
        'id', 'name', 'description', 'status', 'cover', 'user_id', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
