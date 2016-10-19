<?php

namespace App\Repositories;

use App\Bookmark;

class BookmarkRepository extends Repository
{
    protected $model;

    public function __construct(Bookmark $model)
    {
        $this->model = $model;
    }

    public function paginateByUser($user_id, $page)
    {
        return $this->model->where('user_id', $user_id)->paginate($page);
    }
}