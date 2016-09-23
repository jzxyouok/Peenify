<?php

namespace App\Http\Controllers\Backend;

use App\Services\CategoryService;
use App\Services\CollectionService;
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
    /**
     * @var CollectionService
     */
    private $collectionService;

    public function __construct(ProductService $productService, CategoryService $categoryService, TagService $tagService, CollectionService $collectionService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->collectionService = $collectionService;
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
        $tags = $this->tagService->paginate(10);

        return view('backend.tags', compact('tags'));
    }

    public function collections()
    {
        $collections = $this->collectionService->getAllPagination(10);

        return view('backend.collections', compact('collections'));
    }
}
