<?php

namespace App\Http\Controllers\Search\Collection;

use App\Collection;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductList extends Controller
{
    public function __invoke($id)
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋產品關鍵字。');

        $collection = Collection::find($id);

        $products = Product::where('name', 'like', "%{$term}%")->latest()->paginate(6);

        return view('searches.collection.products', compact('products', 'term', 'collection'));
    }
}
