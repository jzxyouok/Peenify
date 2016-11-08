<?php

namespace App;

use App\Foundation\Favorable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes;

    use Favorable;

    protected $table = 'collections';

    protected $fillable = [
        'name', 'description', 'status', 'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function owns()
    {
        return $this->user_id == auth()->user()->id;
    }

    public function paginateProducts($sort = 'latest', $page = 12)
    {
        return $this->products()->{$sort}()->paginate($page);
    }
}
