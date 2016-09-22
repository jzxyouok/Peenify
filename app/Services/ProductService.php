<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends Service
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
        $product = $this->productRepository->create($this->authUser($attributes));

        $product->tag($attributes['tags']);

        if (isset($attributes['authors'])) {
            $this->syncAuthorIfExist($attributes['authors'], $product);
        }

        if (isset($attributes['actors'])) {
            $this->syncActorIfExist($attributes['actors'], $product);
        }

        return $product;
    }

    public function findOrFail($id)
    {
        return $this->productRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->productRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }

    public function syncAuthorIfExist($authorsId, $product)
    {
        if (!empty($authorsId)) {
            $this->productRepository->syncAuthors($product, $authorsId);
        }

        return;
    }

    public function syncActorIfExist($actorsId, $product)
    {
        if (!empty($actorsId)) {
            $this->productRepository->syncActors($product, $actorsId);
        }

        return;
    }
}