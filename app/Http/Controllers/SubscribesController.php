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
