<?php

namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    /**
     * @var \Eloquent
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function getUserByIds($userIds)
    {
        return $this->model->whereIn('id', $userIds)->get();
    }

    public function paginateUsersByIds($userIds, $page)
    {
        return $this->model->whereIn('id', $userIds)->paginate($page);
    }

    public function attachRoles($user_id, $role_ids)
    {
        $user = $this->model->find($user_id);

        return $user->roles()->attach($role_ids);
    }

    public function fillToSave($instance, $attributes)
    {
        return $instance->fill($attributes)->save();
    }

    public function LatestPagination($page = 10)
    {
        return $this->model->latest()->paginate($page);
    }
}