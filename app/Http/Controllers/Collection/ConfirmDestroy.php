<?php

namespace App\Http\Controllers\Collection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmDestroy extends Controller
{
    public function __invoke($id)
    {
        return view('collections.destroy', compact('id'));
    }
}
