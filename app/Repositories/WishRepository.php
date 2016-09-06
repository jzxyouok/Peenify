<?php

namespace App\Repositories;

use App\Wish;

class WishRepository extends Repository
{
    protected $model;

    public function __construct(Wish $model)
    {
        $this->model = $model;
    }

    public function getAllByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function destroyByUser($product_id, $user_id)
    {
        return $this->model->where('user_id', $user_id)->where('product_id', $product_id)->delete();
    }

    public function getWishByProduct($product_id, $user_id)
    {
        return $this->model->where('product_id', $product_id)->where('user_id', $user_id)->exists();
    }
}