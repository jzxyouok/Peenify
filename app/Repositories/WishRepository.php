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

    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }
}