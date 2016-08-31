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

    public function saveComment($commentable_type, $commentable_id, $attributes)
    {
        $instance = app('App\\' . ucfirst($commentable_type))->find($commentable_id);

        $comment = new Comment($attributes);

        return $instance->comments()->save($comment);
    }
}