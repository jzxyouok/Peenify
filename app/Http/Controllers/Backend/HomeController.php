<?php

namespace App\Http\Controllers\Backend;

use App\Services\ActorService;
use App\Services\ArticleService;
use App\Services\AuthorService;
use App\Services\CategoryService;
use App\Services\CollectionService;
use App\Services\ProductService;
use App\Services\TagService;
use App\Services\UserService;
use App\Services\VendorService;
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
    /**
     * @var AuthorService
     */
    private $authorService;
    /**
     * @var ActorService
     */
    private $actorService;
    /**
     * @var VendorService
     */
    private $vendorService;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * HomeController constructor.
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @param TagService $tagService
     * @param CollectionService $collectionService
     * @param AuthorService $authorService
     * @param ActorService $actorService
     * @param VendorService $vendorService
     * @param UserService $userService
     * @param ArticleService $articleService
     */
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        TagService $tagService,
        CollectionService $collectionService,
        AuthorService $authorService,
        ActorService $actorService,
        VendorService $vendorService,
        UserService $userService,
        ArticleService $articleService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->collectionService = $collectionService;
        $this->authorService = $authorService;
        $this->actorService = $actorService;
        $this->vendorService = $vendorService;
        $this->userService = $userService;
        $this->articleService = $articleService;
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

    public function authors()
    {
        $authors = $this->authorService->getAllPagination(10);

        return view('backend.authors', compact('authors'));
    }

    public function actors()
    {
        $actors = $this->actorService->getAllPagination(10);

        return view('backend.actors', compact('actors'));
    }

    public function vendors()
    {
        $vendors = $this->vendorService->getAllPagination(10);

        return view('backend.vendors', compact('vendors'));
    }

    public function users()
    {
        $users = $this->userService->getAllPagination(10);

        return view('backend.users', compact('users'));
    }

    public function articles()
    {
        $articles = $this->articleService->getAllPagination(10);

        return view('backend.articles', compact('articles'));
    }
}
