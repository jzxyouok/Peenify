<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';

    protected $fillable = [
        'subscribable_type', 'subscribable_id', 'user_id',
    ];

    public function subscribable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
