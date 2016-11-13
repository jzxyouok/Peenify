<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\createRequest;
use App\Http\Requests\Product\updateRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllPagination(12);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(createRequest $request)
    {
        $filename = (is_null($request->file('cover'))) ? null : upload_image('products', $request->file('cover'));

        $data = $request->all();

        $this->productService->create(array_set($data, 'cover', $filename));

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

    public function update(updateRequest $request, $id)
    {
        $this->productService->update($id, update_image($request, 'cover', 'products'));

        return redirect()->route('products.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
