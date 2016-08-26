<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function all()
    {
        return $this->commentRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->commentRepository->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->commentRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->commentRepository->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->commentRepository->destroy($id);
    }
}