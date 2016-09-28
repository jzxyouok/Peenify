<?php

namespace App\Repositories;

use App\Permission;

class PermissionRepository extends Repository
{
    /**
     * @var Permission
     */
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}