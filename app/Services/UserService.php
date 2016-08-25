<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
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
        ]);
    }
}