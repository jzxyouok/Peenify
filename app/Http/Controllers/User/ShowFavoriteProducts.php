<?php

namespace App\Http\Controllers\User;

use App\Services\FavoriteService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowFavoriteProducts extends Controller
{
    /**
     * @var FavoriteService
     */
    private $favoriteService;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(FavoriteService $favoriteService, UserService $userService)
    {
        $this->favoriteService = $favoriteService;
        $this->userService = $userService;
    }

    public function __invoke($id)
    {
        $user = $this->userService->findOrFail($id);

        $favorites = $this->favoriteService->getPaginationByUser($id, 12);

        return view('users.favorites.products', compact('favorites', 'user'));
    }
}
