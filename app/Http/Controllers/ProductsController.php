<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->productService->all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->productService->create($request->all());

        return redirect()->route('products.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $product = $this->productService->findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->productService->update($id, $request->all());

        return redirect()->route('products.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);

        return redirect()->route('products.index')->with('message', '刪除成功');
    }
}
