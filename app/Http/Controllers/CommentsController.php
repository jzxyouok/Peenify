<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        $comments = $this->commentService->all();

        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $this->commentService->create($request->all());

        return redirect()->route('comments.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $comment = $this->commentService->findOrFail($id);

        return view('comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = $this->commentService->findOrFail($id);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $this->commentService->update($id, $request->all());

        return redirect()->route('comments.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->commentService->destroy($id);

        return redirect()->route('comments.index')->with('message', '刪除成功');
    }
}
