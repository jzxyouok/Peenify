<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchesController extends Controller
{
    public function result()
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋產品關鍵字。');

        $products = Product::where('name', 'like', "%{$term}%")->latest()->paginate(6);

        return view('searches.products', compact('products', 'term'));
    }

    public function resultForCollections()
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋收藏集關鍵字。');

        $collections = Collection::where('name', 'like', "%{$term}%")->paginate(12);

        return view('searches.collections', compact('collections', 'term'));
    }
}
