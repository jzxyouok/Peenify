<?php

namespace App\Services;

use App\Repositories\FavoriteRepository;

class FavoriteService
{
    /**
     * @var FavoriteRepository
     */
    private $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function findByUser($user_id)
    {
        return $this->favoriteRepository->getByUser($user_id);
    }

    public function getPaginationByUser($user_id, $page = 10)
    {
        return $this->favoriteRepository->paginateByUser($user_id, $page);
    }
}