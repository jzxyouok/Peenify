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

    public function owns()
    {
        if (empty(func_get_args())) {
            return $this->user_id == auth()->user()->id;
        }

        if (func_get_arg(0) instanceof User) {
            $user = func_get_arg(0);

            return $this->user_id == $user->id;
        }

        throw new \InvalidArgumentException("Must be instance of User");
    }

    public function updateByOwner(array $attributes)
    {
        if ($this->owns(auth()->user())) {
            return $this->update($attributes);
        }

        return false;
    }
}
