<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{
    protected $table = 'emojis';

    protected $fillable = [
        'emojiable_type', 'emojiable_id', 'user_id', 'type'
    ];

    public function emojiable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
