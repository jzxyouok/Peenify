<?php

namespace App\Http\Controllers\Bookmark;

use App\Services\BookmarkService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncRelations extends Controller
{
    /**
     * @var BookmarkService
     */
    private $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    public function __invoke($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isBookmark(auth()->user())) {
            $instance->removeBookmark(auth()->user());

            return response()->json(['status' => 'removeBookmark']);
        }

        $instance->bookmark(auth()->user());

        return response()->json(['status' => 'bookmark']);
    }
}
