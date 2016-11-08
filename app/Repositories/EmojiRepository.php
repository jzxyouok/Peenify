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

    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function paginateByUser($user_id, $page, $type)
    {
        return $this->model->where([
            'emojiable_type' => $type,
            'user_id' => $user_id
        ])->paginate($page);
    }
}