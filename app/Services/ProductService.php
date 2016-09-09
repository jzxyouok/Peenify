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

        $cover = (isset($attributes['cover'])) ?
            $attributes['cover']->storeAs(config('image-path.cover.product') . $product->id,
                $attributes['cover']->hashName(), 'public') : null;

        $product->cover = $cover;

        $product->save();

        return $product;
    }

    public function findOrFail($id)
    {
        return $this->productRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        if (isset($attributes['cover'])) {
            $attributes['cover']->storeAs(config('image-path.cover.product') . $id,
                $cover = $attributes['cover']->hashName(), 'public');
            $attributes = array_set($attributes, 'cover', $cover);
        }

        return $this->productRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }
}