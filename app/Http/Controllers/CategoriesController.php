<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        $categories = $this->categoryService->all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->categoryService->create($request->all());

        return redirect()->route('categories.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $category = $this->categoryService->findOrFail($id);

        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryService->update($id, $request->all());

        return redirect()->route('categories.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->categoryService->destroy($id);

        return redirect()->route('categories.index')->with('message', '刪除成功');
    }
}
