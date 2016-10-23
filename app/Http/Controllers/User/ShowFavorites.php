<?php

namespace App\Http\Controllers\User;

use App\Services\FavoriteService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowFavorites extends Controller
{
    /**
     * @var FavoriteService
     */
    private $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function __invoke($id)
    {
        $favorites = $this->favoriteService->getPaginationByUser($id, 12);

        return view('users.favorites', compact('favorites'));
    }
}
