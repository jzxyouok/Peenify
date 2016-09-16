<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{
    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->all();

        return view('tags.index', compact('tags'));
    }

    public function show($id)
    {
        $tag = $this->tagService->findOrFail($id);

        return view('tags.show', compact('tag'));
    }

    public function ajaxTags()
    {
        $name = request()->get('term');

        if (!$name) {
            return response()->json('No results found');
        }

        return response()->json($this->tagService->getLikeTagsByName($name));
    }
}
