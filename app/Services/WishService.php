<?php

namespace App\Services;

use App\Repositories\WishRepository;

class WishService extends Service
{
    /**
     * @var WishRepository
     */
    private $wishRepository;

    public function __construct(WishRepository $wishRepository)
    {
        $this->wishRepository = $wishRepository;
    }

    public function create($product_id)
    {
        $attributes = array('product_id' => $product_id);

        return $this->wishRepository->create($this->authUser($attributes));
    }

    public function getAllByUser($user_id)
    {
        return $this->wishRepository->getAllByUser($user_id);
    }

    public function destroy($product_id)
    {
        return $this->wishRepository->destroyByUser($product_id, auth()->user()->id);
    }
}