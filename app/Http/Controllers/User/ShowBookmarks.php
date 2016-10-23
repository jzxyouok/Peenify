<?php

namespace App\Http\Controllers\User;

use App\Services\BookmarkService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowBookmarks extends Controller
{
    /**
     * @var BookmarkService
     */
    private $bookmarkService;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(BookmarkService $bookmarkService, UserService $userService)
    {
        $this->bookmarkService = $bookmarkService;
        $this->userService = $userService;
    }

    public function __invoke($id)
    {
        $user = $this->userService->findOrFail($id);

        $bookmarks = $this->bookmarkService->getPaginationByUser($id, 12);

        return view('users.bookmarks', compact('bookmarks', 'user'));
    }
}
