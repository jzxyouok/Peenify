<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends Repository
{
    /**
     * @var Comment
     */
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}