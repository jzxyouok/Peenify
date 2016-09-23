<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository extends Repository
{
    /**
     * @var Category
     */
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}