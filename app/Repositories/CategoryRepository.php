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
}