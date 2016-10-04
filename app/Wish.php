<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $table = 'wishes';

    protected $fillable = [
        'wishable_type',
        'wishable_id',
        'user_id',
    ];

    public function wishable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
