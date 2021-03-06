<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\updateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->all();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userService->findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit()
    {
        $user = $this->userService->findOrFail(auth()->user()->id);

        return view('users.edit', compact('user'));
    }

    public function update(updateRequest $request)
    {
        $this->userService->update(update_image($request, 'avatar', 'avatars.users'));

        return redirect()->route('users.show', auth()->user()->id)->with('message', '編輯成功');
    }
}
