<?php

namespace App\Services;

use App\Repositories\CollectionRepository;

class CollectionService
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
        return $this->collectionRepository->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->collectionRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->collectionRepository->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->collectionRepository->destroy($id);
    }
}