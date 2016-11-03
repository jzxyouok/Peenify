<?php

namespace App\Http\Controllers\Search\Collection;

use App\Collection;
use App\Product;
use App\Services\CollectionService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductList extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var CollectionService
     */
    private $collectionService;

    public function __construct(ProductService $productService, CollectionService $collectionService)
    {
        $this->productService = $productService;
        $this->collectionService = $collectionService;
    }

    public function __invoke($id)
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋產品關鍵字。');

        $collection = $this->collectionService->findOrFail($id);

        $products = $this->productService->paginateSearchResult($term, 12);

        return view('searches.collection.products', compact('products', 'term', 'collection'));
    }
}
