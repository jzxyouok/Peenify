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

    public function create(array $attributes = [])
    {
        return parent::setSlugGenerator()->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $product = $this->model->find($id);

        $product->update($attributes);

        $product->tag($attributes['tags']);

        return $product->save();
    }

    public function syncAuthors($product, $authorsId)
    {
        return $product->authors()->sync($authorsId);
    }

    public function syncActors($product, $actorsId)
    {
        return $product->actors()->sync($actorsId);
    }
}