<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\AuthorService;
use App\Services\CategoryService;
use App\Services\CollectionService;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
    /**
     * @var CollectionService
     */
    private $collectionService;
    /**
     * @var AuthorService
     */
    private $authorService;

    public function __construct(ProductService $productService, CategoryService $categoryService, CollectionService $collectionService, AuthorService $authorService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->collectionService = $collectionService;
        $this->authorService = $authorService;
    }

    /**
     * 所有產品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productService->all();

        return view('products.index', compact('products'));
    }

    /**
     * 因為建立產品時必須選擇一個類別，所以先撈取了所有類別
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryService->all();

        $authors = $this->authorService->all();

        return view('products.create', compact('categories', 'authors'));
    }

    /**
     * 建立產品
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $filename = (is_null($request->file('cover'))) ? null : upload_image('products', $request->file('cover'));

        $data = $request->all();

        $product = $this->productService->create(array_set($data, 'cover', $filename));

        if (!empty($request->get('authors'))) {
            $product->authors()->sync($request->get('authors'));
        }

        return redirect()->route('products.index')->with('message', '建立成功');
    }

    /**
     * 顯示個別產品
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = $this->productService->findOrFail($id);

        $collections = $this->collectionService->getAllByUser(auth()->user()->id);

        return view('products.show', compact('product', 'collections'));
    }

    /**
     * 編輯產品頁面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryService->all();

        $product = $this->productService->findOrFail($id);

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * 建立與更新相同 Request 邏輯，此外 Tag 的部分還無法正常顯示在欄位內
     * @param ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, update_image($request, 'cover', 'products'));

        return redirect()->route('products.show', $id)->with('message', '編輯成功');
    }

    /**
     * 刪除產品，目前是直接刪除，要修改為軟刪除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->productService->destroy($id);

        return redirect()->route('products.index')->with('message', '刪除成功');
    }
}
