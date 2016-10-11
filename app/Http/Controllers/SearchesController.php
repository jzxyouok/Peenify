<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchesController extends Controller
{
    public function result()
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋產品關鍵字。');

        $products = Product::where('name', 'like', "%{$term}%")->paginate(10);

        return view('searches.products', compact('products', 'term'));
    }
}
