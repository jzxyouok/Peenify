<?php

namespace App\Services;

use App\Repositories\FollowRepository;
use App\Repositories\UserRepository;

class FollowService extends Service
{

    /**
     * @var FollowRepository
     */
    private $followRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(FollowRepository $followRepository, UserRepository $userRepository)
    {
        $this->followRepository = $followRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllByUser($user_id)
    {
        return $this->followRepository->getAllByUser($user_id);
    }

    public function getUserByType($user_id)
    {
        $userIds = $this->followRepository->getUserByType($user_id)->map(function($followed) {
            return $followed->user_id;
        });

        return $this->userRepository->getUserByIds($userIds->toArray());
    }

    public function syncFollow($followable_type, $followable_id, $attributes)
    {
        $instance = app(ucfirst('App\\' . $followable_type));

        return $instance->syncFollow($followable_id, array_add($attributes, 'user_id', auth()->user()->id));
    }
}