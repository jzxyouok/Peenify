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

        $this->syncAuthorIfExist(array_get($attributes, 'authors'), $product);

        $this->syncActorIfExist(array_get($attributes, 'actors'), $product);

        $this->addToMovieOptions($product, array_get($attributes,'movie'));

        $this->addToSeriesOptions($product, array_get($attributes,'series'));

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

    public function getAllPagination($page)
    {
        return $this->productRepository->LatestPagination($page);
    }

    private function addToMovieOptions($product, $options)
    {
        if (!empty($options)) {
            return $this->productRepository->saveToMovie($product, $options);
        }
        
        return;
    }

    private function addToSeriesOptions($product, $options)
    {
        if (!empty($options)) {
            return $this->productRepository->saveToSeries($product, $options);
        }

        return;
    }
}