<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WishlistsController extends Controller
{
    /**
     * @var WishlistService
     */
    private $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $wishlists = $this->wishlistService->all();

        return view('wishlists.index', compact('wishlists'));
    }

    public function create()
    {
        return view('wishlists.create');
    }

    public function store(Request $request)
    {
        $this->wishlistService->create($request->all());

        return redirect()->route('wishlists.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $wishlist = $this->wishlistService->findOrFail($id);

        return view('wishlists.show', compact('wishlist'));
    }

    public function edit($id)
    {
        $wishlist = $this->wishlistService->findOrFail($id);

        return view('wishlists.edit', compact('wishlist'));
    }

    public function update(Request $request, $id)
    {
        $this->wishlistService->update($id, $request->all());

        return redirect()->route('wishlists.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->wishlistService->destroy($id);

        return redirect()->route('wishlists.index')->with('message', '刪除成功');
    }
}
