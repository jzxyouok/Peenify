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

    public function getPaginationByUser($user_id, $page = 10)
    {
        return $this->wishRepository->paginateByUser($user_id, $page);
    }
}