<?php

namespace App\Http\Controllers\Subscribe;

use App\Services\SubscribeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncRelations extends Controller
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
