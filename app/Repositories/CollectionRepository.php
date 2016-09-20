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

    public function syncProduct($id, $product_id)
    {
        $collection = $this->model->find($id);

        return $collection->products()->sync(array($product_id));
    }

    public function getAllByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }
}