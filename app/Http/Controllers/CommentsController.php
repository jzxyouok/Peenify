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

    public function store(Request $request, $product_id)
    {
        $this->commentService->create($request->all(), $product_id);

        return redirect()->route('products.show', $product_id)->with('message', '建立成功');
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
