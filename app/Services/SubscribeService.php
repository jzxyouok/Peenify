<?php

namespace App\Services;

use App\Mail\SubscribedUser;
use App\Product;
use App\Repositories\ProductRepository;
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
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(SubscribeRepository $subscribeRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->subscribeRepository = $subscribeRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function subscribers($type, $id, $page)
    {
        $userIds = $this->subscribeRepository->pluckSubscriber($type, $id)->toArray();

        return $this->userRepository->paginateUsersByIds($userIds, $page);
    }

    public function subscribed($type, $id, $page)
    {
        $userIds = $this->subscribeRepository->pluckSubscribed($type, $id)->toArray();

        return $this->userRepository->paginateUsersByIds($userIds, $page);
    }

    public function sendMailToSubscribedUser($instance)
    {
        if ($instance instanceof User) {
            return Mail::to($instance->email)->later(config('queue.mail.subscription'), new SubscribedUser($instance, auth()->user()));
        }

        return;
    }

    public function existSubscribe($type, User $user)
    {
        return $this->subscribeRepository->existSubscribe($type, $user->id);
    }

    public function forUserProducts(User $user)
    {
        $category_ids = $this->subscribeRepository->pluckSubscribed('category', $user->id)->toArray();

        return Product::whereIn('category_id', $category_ids)->latest()->paginate(6);
    }
}