<?php

namespace App\Repositories;

use App\Follow;

class FollowRepository extends Repository
{
    protected $model;

    public function __construct(Follow $model)
    {
        $this->model = $model;
    }

    public function getAllByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function getUserByType($user_id)
    {
        return $this->model->where('followable_type', 'user')->where('followable_id', $user_id)->get();
    }
}