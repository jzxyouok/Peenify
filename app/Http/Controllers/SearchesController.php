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

        $products = Product::where('name', 'like', "%{$term}%")->paginate(10);

        return view('searches.products', compact('products', 'term'));
    }
}
