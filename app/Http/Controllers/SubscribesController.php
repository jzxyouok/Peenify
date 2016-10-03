<?php

namespace App\Http\Controllers;

use App\Services\SubscribeService;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubscribesController extends Controller
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
     * 訂閱你的人
     */
    public function subscriber($type, $id)
    {
        $subscribers = $this->subscribeService->subscribers($type, $id);

        return view("{$type}s.subscribers", compact('subscribers'));
    }

    /**
     * 訂閱清單
     */
    public function subscribed($type, $id)
    {
        $subscribed = $this->subscribeService->subscribed($type, $id);

        return view("{$type}s.subscribed", compact('subscribed'));
    }

    public function sync($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isSubscribe(auth()->user())) {
            $instance->describe(auth()->user());

            return response()->json(['status' => 'describe']);
        }

        $this->subscribeService->sendMailToSubscribedUser($instance);

        $instance->subscribe(auth()->user());

        return response()->json(['status' => 'subscribe']);
    }
}
