<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * 分類首頁
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryService->all();

        return view('categories.index', compact('categories'));
    }

    /**
     * 建立分類
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * 儲存分類
     * @param Category $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $filename = (is_null($request->file('cover'))) ? null : upload_image('category', $request->file('cover'));

        $data = $request->all();

        $this->categoryService->create(array_set($data, 'cover', $filename));

        return redirect()->route('categories.index')->with('message', '建立成功');
    }

    /**
     * 顯示單獨分類
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $category = $this->categoryService->findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * 編輯分類
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryService->findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * 更新分類
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->categoryService->update($id, update_image($request, 'cover', 'category'));

        return redirect()->route('categories.show', $id)->with('message', '編輯成功');
    }

    /**
     * 刪除分類
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryService->destroy($id);

        return redirect()->route('categories.index')->with('message', '刪除成功');
    }
}
