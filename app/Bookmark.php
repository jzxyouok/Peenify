<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';

    protected $fillable = [
        'bookmarkable_type',
        'bookmarkable_id',
        'user_id',
    ];

    public function bookmarkable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owns()
    {
        return $this->user_id == auth()->user()->id;
    }
}
