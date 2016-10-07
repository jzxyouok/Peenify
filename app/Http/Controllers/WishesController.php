<?php

namespace App\Http\Controllers;

use App\Services\WishService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WishesController extends Controller
{
    /**
     * @var WishService
     */
    private $wishService;

    public function __construct(WishService $wishService)
    {
        $this->wishService = $wishService;
    }

    public function sync($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isWish(auth()->user())) {
            $instance->unWish(auth()->user());

            return response()->json(['status' => 'unWish']);
        }

        $instance->wish(auth()->user());

        return response()->json(['status' => 'wish']);
    }

    public function showByUser($user_id)
    {
        $wishes = $this->wishService->getPaginationByUser($user_id, 10);

        return view('users.wishes', compact('wishes'));
    }
}
