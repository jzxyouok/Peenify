<?php

namespace App\Http\Controllers;

use App\Services\FollowService;
use Illuminate\Http\Request;

use App\Http\Requests;

class FollowsController extends Controller
{
    /**
     * @var FollowService
     */
    private $followService;

    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    public function sync(Request $request, $followable_type, $followable_id)
    {
        $result = $this->followService->syncFollow($followable_type, $followable_id, $request->all());

        return redirect()->back()->with('message', ($result) ? '新建成功' : '刪除成功');
    }

    public function showByUser($user_id)
    {
        $follows = $this->followService->getAllByUser($user_id);

        $followeds = $this->followService->getUserByType($user_id);

        return view('users.follows', compact('follows', 'followeds'));
    }
}
