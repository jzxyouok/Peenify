<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService extends Service
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function all()
    {
        return $this->authorRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->authorRepository->create($this->authUser($attributes));
    }

    public function findOrFail($id)
    {
        return $this->authorRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->authorRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->authorRepository->destroy($id);
    }

    public function getAllPagination($page)
    {
        return $this->authorRepository->LatestPagination($page);
    }
}