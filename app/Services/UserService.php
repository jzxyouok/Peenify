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
        return $this->userRepository->updateOrCreate(['email' => $user->email], [
            'facebook_user_id' => $user->id,
            'name'     => $user->name,
            'password' => bcrypt(str_random(10)),
        ]);
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
        if (isset($attributes['avatar'])) {
            $attributes['avatar']->storeAs(config('image-path.avatar.user') .  $id, $avatar = $attributes['avatar']->hashName(), 'public');
            $attributes = array_set($attributes, 'avatar', $avatar);
        }

        return $this->userRepository->update($id, $attributes);
    }

    public function attachRoles($id, $role_ids)
    {
        return $this->userRepository->attachRoles($id, (array)$role_ids);
    }
}