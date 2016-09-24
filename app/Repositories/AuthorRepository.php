<?php

namespace App\Repositories;

use App\Author;

class AuthorRepository extends Repository
{
    /**
     * @var Author
     */
    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}