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
}