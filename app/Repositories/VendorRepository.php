<?php

namespace App\Repositories;

use App\Vendor;

class VendorRepository extends Repository
{
    protected $model;

    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}