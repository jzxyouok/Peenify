<?php

namespace App\Services;

use App\Repositories\CollectionRepository;

class CollectionService extends Service
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;

    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function all()
    {
        return $this->collectionRepository->all();
    }

    public function create(array $attributes)
    {
        return auth()->user()->collections()->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->collectionRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->collectionRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->collectionRepository->destroy($id);
    }

    public function attachProduct($id, $product_id)
    {
        return $this->collectionRepository->attachProduct($id, $product_id);
    }

    public function getAllByUser($user_id)
    {
        return $this->collectionRepository->getAllByUser($user_id);
    }

    public function duplicateProductInCollection($id, $product_id)
    {
        $collection = $this->collectionRepository->findOrFail($id);

        foreach ($collection->products()->get() as $product) {
            if ($product->id == $product_id) {
                return true;
            }
        }

        return false;
    }

    public function getAllPagination($page)
    {
        return $this->collectionRepository->LatestPagination($page);
    }
}