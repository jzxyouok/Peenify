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

    public function paginateByUser($user_id, $page)
    {
        return $this->model->where('user_id', $user_id)->paginate($page);
    }
}