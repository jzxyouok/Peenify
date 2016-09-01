<?php

namespace App\Repositories;

use App\Emoji;

class EmojiRepository extends Repository
{
    protected $model;

    public function __construct(Emoji $model)
    {
        $this->model = $model;
    }

    public function getAllByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }
}