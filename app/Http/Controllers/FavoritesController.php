<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;

use App\Http\Requests;

class FavoritesController extends Controller
{
    /**
     * @var FavoriteService
     */
    private $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function sync($type, $id)
    {
        $instance = app(ucfirst('App\\' . $type))->find($id);

        if ($instance->isFavorite(auth()->user())) {
            $instance->unFavorite(auth()->user());

            return response()->json(['status' => 'unFavorite']);
        }

        $instance->favorite(auth()->user());

        return response()->json(['status' => 'favorite']);
    }
}
