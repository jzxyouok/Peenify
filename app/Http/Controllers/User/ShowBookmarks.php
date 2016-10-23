<?php

namespace App\Http\Controllers\User;

use App\Services\BookmarkService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowBookmarks extends Controller
{
    /**
     * @var BookmarkService
     */
    private $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    public function __invoke($id)
    {
        $bookmarks = $this->bookmarkService->getPaginationByUser($id, 12);

        return view('users.bookmarks', compact('bookmarks'));
    }
}
