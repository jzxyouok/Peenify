<?php

namespace App\Services;

use App\Repositories\WishlistRepository;

class WishlistService
{
    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;

    public function __construct(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function all()
    {
        return $this->wishlistRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->wishlistRepository->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->wishlistRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->wishlistRepository->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->wishlistRepository->destroy($id);
    }
}