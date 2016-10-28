<?php

namespace App\Repositories;

use App\Subscribe;

class SubscribeRepository
{
    /**
     * @var Subscribe
     */
    protected $model;

    public function __construct(Subscribe $model)
    {
        $this->model = $model;
    }

    public function pluckSubscriber($type, $id, $pluckColumn = 'user_id')
    {
        return $this->model->where([
            'subscribable_type' => $type,
            'subscribable_id' => $id
        ])->pluck($pluckColumn);
    }

    public function pluckSubscribed($type, $id, $pluckColumn = 'subscribable_id')
    {
        return $this->model->where([
            'subscribable_type' => $type,
            'user_id' => $id
        ])->pluck($pluckColumn);
    }

    public function existSubscribe($type, $user_id)
    {
        return $this->model->where([
            'subscribable_type' => $type,
            'user_id' => $user_id
        ])->exists();
    }
}