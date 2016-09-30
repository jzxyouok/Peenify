<?php

namespace App;

use App\Foundation\Emojiable;
use App\Foundation\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Tags\TaggableTrait;

class Product extends Model
{
    use TaggableTrait;
    use Favoriteable, Emojiable;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
        'cover',
        'user_id',
        'category_id',
        'launched_at',
        'site'
    ];

    public function setSlug()
    {
        $this->setSlugGenerator(function($name) {
            return base64_encode($name);
        });

        return $this;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    public function syncAuthors($authorIds)
    {
        if (! empty($authorIds)) {
            $this->authors()->sync((array) $authorIds);
        }

        return $this;
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function syncActors($actorIds)
    {
        if (! empty($actorIds)) {
            $this->actors()->sync((array) $actorIds);
        }

        return $this;
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }

    public function giveMovieTo($options)
    {
        if (! empty($options)) {
            $this->movie()->save(new Movie($options));
        }

        return $this;
    }

    public function series()
    {
        return $this->hasOne(Series::class);
    }

    public function giveSeriesTo($options)
    {
        if (! empty($options)) {
            $this->series()->save(new Series($options));
        }

        return $this;
    }
}
