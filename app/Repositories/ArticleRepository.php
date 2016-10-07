<?php

namespace App\Repositories;

use App\Article;

class ArticleRepository extends Repository
{
    /**
     * @var Article
     */
    protected $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}