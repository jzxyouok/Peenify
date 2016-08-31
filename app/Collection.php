<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';

    protected $fillable = [
        'name', 'description', 'status', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
