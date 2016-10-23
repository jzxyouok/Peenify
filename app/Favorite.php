<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
        'favorable_type',
        'favorable_id',
        'user_id',
    ];

    public function favorable()
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
