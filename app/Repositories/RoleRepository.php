<?php

namespace App\Repositories;

use App\Role;

class RoleRepository extends Repository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}