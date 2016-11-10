<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'animes';

    protected $fillable = [
        'product_id', 'origin_name', 'runtime_at', 'trailer', 'country'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
