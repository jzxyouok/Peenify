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

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->where('user_id', auth()->user()->id);
    }
}
