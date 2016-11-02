<?php

namespace App\Http\Controllers\Collection;

use App\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncProduct extends Controller
{
    public function __invoke($id, $product_id)
    {
        $collection = Collection::find($id);

        if ($collection->products()->where('product_id', $product_id)->exists()) {
            $collection->products()->detach($product_id);

            return response()->json(['status' => 'detach']);
        }

        $collection->products()->attach($product_id);

        return response()->json(['status' => 'attach']);
    }
}
