<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = [
        'name', 'description', 'status'
    ];
}
