<?php

namespace App\Http\Controllers\Subscribe;

use App\Services\SubscribeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowSubscribed extends Controller
{
    /**
     * @var SubscribeService
     */
    private $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    public function __invoke($type, $id)
    {
        $subscribed = $this->subscribeService->subscribed($type, $id, 12);

        return view("{$type}s.subscribed", compact('subscribed'));
    }
}
