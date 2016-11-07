<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\createRequest;
use App\Http\Requests\Comment\updateRequest;
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

    public function store(createRequest $request, $product_id)
    {
        $result = $this->commentService->create(array_add($request->all(), 'product_id', $product_id));

        if (! $result) {
            return back()->with('warning', 'Oops! 每個使用者只能評論一次');
        }

        return redirect()->route("products.show", $product_id)->with('message', '建立成功');
    }

    public function edit($id)
    {
        $comment = $this->commentService->findOrFail($id);

        $product_id = request()->get('pid');

        if (! $comment) {
            return back()->with('warning', 'Oops! 你不是發表此評論的人');
        }

        return view('comments.edit', compact('comment', 'product_id'));
    }

    public function update(updateRequest $request, $id)
    {
        $comment = $this->commentService->update($id, $request->all());

        if (! $comment) {
            return back()->with('warning', 'Oops! 你不是發表此評論的人');
        }

        return redirect()->route('products.show', $request->get('product_id'))->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->commentService->destroy($id);

        return redirect()->route('comments.index')->with('message', '刪除成功');
    }
}
