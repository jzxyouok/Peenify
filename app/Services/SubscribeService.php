<?php

namespace App\Services;

use App\Mail\SubscribedUser;
use App\Repositories\SubscribeRepository;
use App\Repositories\UserRepository;
use App\User;
use Mail;

class SubscribeService
{
    /**
     * @var SubscribeRepository
     */
    private $subscribeRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(SubscribeRepository $subscribeRepository, UserRepository $userRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
        $this->userRepository = $userRepository;
    }

    public function subscribers($type, $id)
    {
        $userIds = $this->subscribeRepository->pluckSubscriber($type, $id)->toArray();

        return $this->userRepository->getUserByIds($userIds);
    }

    public function subscribed($type, $id)
    {
        $userIds = $this->subscribeRepository->pluckSubscribed($type, $id)->toArray();

        return $this->userRepository->getUserByIds($userIds);
    }

    public function sendMailToSubscribedUser($instance)
    {
        if ($instance instanceof User) {
            return Mail::to($instance->email)->send(new SubscribedUser($instance, auth()->user()));
        }

        return;
    }
}