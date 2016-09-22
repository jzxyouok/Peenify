<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name', 'count'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable', 'tagged');
    }
}
