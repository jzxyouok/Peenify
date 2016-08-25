<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->productRepository->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->productRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->productRepository->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }
}