<?php

namespace App\Repositories;

use App\Tag;

class TagRepository extends Repository
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getLikeTags($name)
    {
        return $this->model->where('name', 'like', "%" . $name . "%")->get();
    }
}