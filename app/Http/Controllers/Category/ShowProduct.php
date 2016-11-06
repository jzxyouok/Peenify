<?php

namespace App\Http\Controllers\Category;

use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowProduct extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke($id)
    {
        $products = $this->productService->paginateByCategory($id, 12);

        return view('categories.products', compact('products'));
    }
}
