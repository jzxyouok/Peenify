<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;

    protected $table = 'actors';

    protected $fillable = [
        'id', 'name', 'description', 'status', 'gender', 'user_id', 'country', 'avatar'
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
