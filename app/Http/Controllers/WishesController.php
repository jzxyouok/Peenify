<?php

namespace App\Http\Controllers;

use App\Services\WishService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WishesController extends Controller
{
    public function sync($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isWish(auth()->user())) {
            $instance->unWish(auth()->user());

            return response()->json(['status' => 'unWish']);
        }

        $instance->wish(auth()->user());

        return response()->json(['status' => 'wish']);
    }
}
