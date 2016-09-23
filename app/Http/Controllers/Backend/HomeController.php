<?php

namespace App\Http\Controllers\Backend;

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\TagService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
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
     * @var TagService
     */
    private $tagService;

    public function __construct(ProductService $productService, CategoryService $categoryService, TagService $tagService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    public function index()
    {
        return view('backend.index');
    }

    public function products()
    {
        $products = $this->productService->getAllPagination(10);

        return view('backend.products', compact('products'));
    }

    public function categories()
    {
        $categories = $this->categoryService->getAllPagination(10);

        return view('backend.categories', compact('categories'));
    }

    public function tags()
    {
        $tags = $this->tagService->getAllPagination(10);

        return view('backend.tags', compact('tags'));
    }
}
