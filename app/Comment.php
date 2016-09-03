<?php

namespace App;

use App\Extensions\EmojiableTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use EmojiableTrait;

    protected $table = 'comments';

    protected $fillable = [
        'description', 'status', 'user_id', 'product_id',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
