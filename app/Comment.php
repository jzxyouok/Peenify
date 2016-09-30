<?php

namespace App;

use App\Foundation\Emojiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, Emojiable;

    protected $table = 'comments';

    protected $fillable = [
        'description', 'status', 'user_id', 'product_id',
    ];

    protected $dates = ['deleted_at'];

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
