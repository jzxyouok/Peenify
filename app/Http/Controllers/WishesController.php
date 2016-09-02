<?php

namespace App\Http\Controllers;

use App\Services\WishService;
use Illuminate\Http\Request;

use App\Http\Requests;

class WishesController extends Controller
{
    /**
     * @var WishService
     */
    private $wishService;

    public function __construct(WishService $wishService)
    {
        $this->wishService = $wishService;
    }

    public function store($product_id)
    {
        $this->wishService->create($product_id);

        return redirect()->back()->with('message', '新增到願望清單了');
    }

    public function showByUser($user_id)
    {
        $wishes = $this->wishService->getAllByUser($user_id);

        return view('users.wishes', compact('wishes'));
    }

    public function destroy($product_id)
    {
        $this->wishService->destroy($product_id);

        return redirect()->back()->with('message', '移除成功');
    }
}
