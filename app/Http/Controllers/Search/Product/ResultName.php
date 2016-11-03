<?php

namespace App\Http\Controllers\Search\Product;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultName extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke()
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋產品關鍵字。');

        $products = $this->productService->paginateSearchResult($term, 12);

        return view('searches.products', compact('products', 'term'));
    }
}
