<?php

namespace App\Http\Controllers\Subscribe;

use App\Services\SubscribeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowSubscriber extends Controller
{
    /**
     * @var SubscribeService
     */
    private $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    /**
     * 跟隨者
     */
    public function __invoke($type, $id)
    {
        $subscribers = $this->subscribeService->subscribers($type, $id, 12);

        return view("{$type}s.subscribers", compact('subscribers'));
    }
}
