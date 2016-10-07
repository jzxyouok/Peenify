<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService extends Service
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function all()
    {
        return $this->articleRepository->all();
    }

    public function create(array $attributes)
    {
        return auth()->user()->articles()->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->articleRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->articleRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->articleRepository->destroy($id);
    }

    public function getAllPagination($page)
    {
        return $this->articleRepository->LatestPagination($page);
    }
}