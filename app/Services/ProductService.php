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
        $product = auth()->user()->products()->create($attributes);

        $product->setSlug()->tag($attributes['tags']);

        $product->syncAuthors(array_get($attributes, 'authors'))
                ->syncActors(array_get($attributes, 'actors'))
                ->giveMovieTo(array_get($attributes, 'movie'))
                ->giveSeriesTo(array_get($attributes, 'series'));

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

    public function getAllPagination($page)
    {
        return $this->productRepository->LatestPagination($page);
    }
}