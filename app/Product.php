<?php

namespace App;

use App\Extensions\EmojiableTrait;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Tags\TaggableTrait;

class Product extends Model
{
    use EmojiableTrait, TaggableTrait;

    protected $table = 'products';

    protected $fillable = [
        'id', 'name', 'description', 'status', 'cover', 'user_id', 'category_id', 'launched_at', 'site'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class);
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

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }
}
