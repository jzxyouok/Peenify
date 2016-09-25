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

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }

    public function saveToMovie($product, $options)
    {
        return $product->movie()->save(new Movie($options));
    }

    public function saveToSeries($product, $options)
    {
        return $product->series()->save(new Series($options));
    }
}