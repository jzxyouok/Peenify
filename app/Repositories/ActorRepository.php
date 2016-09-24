<?php

namespace App\Repositories;

use App\Actor;

class ActorRepository extends Repository
{
    protected $model;

    public function __construct(Actor $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}