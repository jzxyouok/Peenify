<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
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

    public function store(Request $request, $commentable_type, $commentable_id)
    {
        $this->commentService->saveComment($commentable_type, $commentable_id, $request->all());

        return redirect()->route("{$commentable_type}s.show", $commentable_id)->with('message', '建立成功');
    }

    public function edit($id)
    {
        $comment = $this->commentService->findOrFail($id);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $this->commentService->update($id, $request->all());

        return redirect()->back()->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->commentService->destroy($id);

        return redirect()->route('comments.index')->with('message', '刪除成功');
    }
}
