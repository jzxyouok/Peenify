<?php

namespace App\Repositories;

use App\Favorite;

class FavoriteRepository
{
    /**
     * @var Favorite
     */
    private $model;

    public function __construct(Favorite $model)
    {
        $this->model = $model;
    }

    public function getByUser($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function paginateByUser($user_id, $page)
    {
        return $this->model->where('user_id', $user_id)->paginate($page);
    }
}