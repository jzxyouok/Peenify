<?php

namespace App\Services;

use App\Mail\WelcomeToSite;
use App\Repositories\UserRepository;
use Mail;

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

        if (! $exist) {
            $model->syncRolesTo([1,2]);
            Mail::to($user->email)->send(new WelcomeToSite($user));
        }

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

    public function update(array $attributes)
    {
        return auth()->user()->update($attributes);
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