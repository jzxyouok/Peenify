<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

use App\Http\Requests;

class FavoritesController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function sync(Request $request, $favoriteable_id)
    {
        $result = $this->productService->syncFavoriteByUser($favoriteable_id, auth()->user());

        return response()->json(['status' => ($result) ? 'create' : 'edit']);
    }
}
