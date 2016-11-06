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

    public function getByCategory($category_ids, $page)
    {
        return $this->model->whereIn('category_id', $category_ids)->paginate($page);
    }

    public function paginateSearchResult($term, $sort, $page)
    {
        return $this->model->where('name', 'like', "%{$term}%")->{$sort}()->paginate($page);
    }

    public function paginateByCategory($category_id, $page)
    {
        return $this->model->where('category_id', $category_id)->latest()->paginate($page);
    }
}