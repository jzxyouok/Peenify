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

    public function showByUser($user_id)
    {
        $wishes = $this->wishService->getAllByUser($user_id);

        return view('users.wishes', compact('wishes'));
    }

    public function sync($product_id)
    {
        if ($this->wishService->getWishByProductAndAuth($product_id)) {
            $this->wishService->destroy($product_id);
            $status = 'delete';
        } else {
            $this->wishService->create($product_id);

            $status = 'create';
        }

        return response()->json(['status' => $status]);
    }
}
