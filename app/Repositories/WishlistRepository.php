<?php

namespace App\Repositories;

use App\Wishlist;

class WishlistRepository extends Repository
{
    protected $model;

    public function __construct(Wishlist $model)
    {
        $this->model = $model;
    }
}