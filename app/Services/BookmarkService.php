<?php

namespace App\Services;

use App\Repositories\BookmarkRepository;

class BookmarkService extends Service
{
    /**
     * @var BookmarkRepository
     */
    private $bookmarkRepository;

    public function __construct(BookmarkRepository $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    public function create($product_id)
    {
        $attributes = array('product_id' => $product_id);

        return $this->bookmarkRepository->create($this->authUser($attributes));
    }

    public function getPaginationByUser($user_id, $page = 10)
    {
        return $this->bookmarkRepository->paginateByUser($user_id, $page);
    }
}