<?php

namespace App\Repositories;

use App\Movie;
use App\Product;
use App\Series;

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

    public function update($id, array $attributes)
    {
        $product = $this->model->find($id);

        $product->update($attributes);

        $product->tag($attributes['tags']);

        return $product->save();
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}