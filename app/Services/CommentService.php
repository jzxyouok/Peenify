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

    public function create(array $attributes)
    {
        if (auth()->user()->hasBeenCommentByProduct($attributes['product_id'])) {
            return false;
        }

        return auth()->user()->comments()->create($attributes);
    }

    public function findOrFail($id)
    {
        $comment = $this->commentRepository->findOrFail($id);

        return $comment->owns(auth()->user()) ? $comment : false;
    }

    public function update($id, array $attributes)
    {
        $comment = $this->commentRepository->find($id);

        return $comment->updateByOwner($attributes);
    }

    public function destroy($id)
    {
        return $this->commentRepository->destroy($id);
    }
}