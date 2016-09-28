<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends Service
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateOrCreateWithFacebook($user)
    {
        $model = $this->userRepository->firstOrNew(['email' => $user->email]);

        $exist = $model->exists;

        $this->userRepository->fillToSave($model, [
            'facebook_user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => ($exist) ? $model->password : bcrypt(str_random(10)),
        ]);

//        if (! $exist) {
//            $this->userRepository->attachRoles($model->id, 3); //beta
//        }

        return $model;
    }



    public function all()
    {
        return $this->userRepository->all();
    }

    public function findOrFail($id)
    {
        return $this->userRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->userRepository->update($id, $attributes);
    }

    public function attachRoles($id, $role_ids)
    {
        return $this->userRepository->attachRoles($id, (array)$role_ids);
    }

    public function getAllPagination($page)
    {
        return $this->userRepository->LatestPagination($page);
    }
}