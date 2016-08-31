<?php

namespace App\Repositories;

use App\Comment;
use App\Product;

class ProductRepository extends Repository
{
    /**
     * @var Product
     */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}