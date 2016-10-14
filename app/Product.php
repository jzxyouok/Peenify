<?php

namespace App;

use App\Foundation\Emojiable;
use App\Foundation\Favorable;
use App\Foundation\Wishable;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    use TaggableTrait, Favorable, Wishable, Emojiable;

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

    protected $dates = ['deleted_at'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
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
        if (! options_isEmpty($options)) {
            $this->movie()->save(new Movie($options));
        }

        return $this;
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function giveGameTo($options)
    {
        if (! options_isEmpty($options)) {
            $this->game()->save(new Game($options));
        }

        return $this;
    }

    public function series()
    {
        return $this->hasOne(Series::class);
    }

    public function giveSeriesTo($options)
    {
        if (! options_isEmpty($options)) {
            $this->series()->save(new Series($options));
        }

        return $this;
    }
}
