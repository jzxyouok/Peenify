<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService extends Service
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

    public function create(array $attributes, $product_id)
    {
        $attributes = array_add($attributes, 'product_id', $product_id);

        return $this->commentRepository->create($this->authUser($attributes));
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