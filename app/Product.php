<?php

namespace App;

use App\Foundation\Bookmarkable;
use App\Foundation\Emojiable;
use App\Foundation\Favorable;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    use TaggableTrait, Favorable, Bookmarkable, Emojiable;

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
        'site',
        'options',
    ];

    protected $casts = [
        'options' => 'json',
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

    public function paginateComments($sort = 'latest', $page = 10)
    {
        return $this->comments()->{$sort}()->paginate($page);
    }
}
