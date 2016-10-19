<?php

namespace App\Http\Controllers;

use App\Services\BookmarkService;
use Illuminate\Http\Request;

use App\Http\Requests;

class BookmarksController extends Controller
{
    /**
     * @var BookmarkService
     */
    private $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    public function sync($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isBookmark(auth()->user())) {
            $instance->removeBookmark(auth()->user());

            return response()->json(['status' => 'removeBookmark']);
        }

        $instance->bookmark(auth()->user());

        return response()->json(['status' => 'bookmark']);
    }

    public function showByUser($user_id)
    {
        $bookmarks = $this->bookmarkService->getPaginationByUser($user_id, 10);

        return view('users.bookmarks', compact('bookmarks'));
    }
}
