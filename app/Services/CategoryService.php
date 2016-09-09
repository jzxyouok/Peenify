<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends Service
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function create(array $attributes)
    {
        $category = $this->categoryRepository->create($this->authUser($attributes));

        $cover = (isset($attributes['cover'])) ?
            $attributes['cover']->storeAs(config('image-path.cover.category') . $category->id,
                $attributes['cover']->hashName(), 'public') : null;

        $category->cover = $cover;

        $category->save();

        return $category;
    }

    public function findOrFail($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        if (isset($attributes['cover'])) {
            $attributes['cover']->storeAs(config('image-path.cover.category') . $id,
                $cover = $attributes['cover']->hashName(), 'public');
            $attributes = array_set($attributes, 'cover', $cover);
        }

        return $this->categoryRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}