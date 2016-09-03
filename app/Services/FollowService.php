<?php

namespace App\Services;

use App\Extensions\syncFollowToUser;
use App\Repositories\FollowRepository;

class FollowService extends Service
{
    use syncFollowToUser;

    /**
     * @var FollowRepository
     */
    private $followRepository;

    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function getAllByUser($user_id)
    {
        return $this->followRepository->getAllByUser($user_id);
    }
}