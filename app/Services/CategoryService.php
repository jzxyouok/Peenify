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
        return $this->categoryRepository->create($this->authUser($attributes));
    }

    public function findOrFail($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->categoryRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}