<?php

namespace App\Http\Controllers\Favorite;

use App\Services\FavoriteService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncRelations extends Controller
{
    /**
     * @var FavoriteService
     */
    private $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function __invoke($type, $id)
    {
        $instance = app(ucfirst('App\\' . ucfirst($type)))->find($id);

        if ($instance->isFavorite(auth()->user())) {
            $instance->unFavorite(auth()->user());

            return response()->json(['status' => 'unFavorite']);
        }

        $instance->favorite(auth()->user());

        return response()->json(['status' => 'favorite']);
    }
}
