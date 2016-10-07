<?php

namespace App\Repositories;

use App\Collection;

class CollectionRepository extends Repository
{
    protected $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    public function attachProduct($id, $product_id)
    {
        $collection = $this->model->find($id);

        return $collection->products()->attach($product_id);
    }

    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }

    public function paginateByUser($user_id, $page)
    {
        return $this->model->where('user_id', $user_id)->paginate($page);
    }
}