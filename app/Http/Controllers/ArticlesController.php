<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticlesController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAllPagination(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->articleService->create($request->all());

        return redirect()->route('articles.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $article = $this->articleService->findOrFail($id);

        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->articleService->findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $this->articleService->update($id, $request->all());

        return redirect()->route('articles.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->articleService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
