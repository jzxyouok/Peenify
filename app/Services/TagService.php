<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getLikeTagsByName($name)
    {
        return $this->tagRepository->getLikeTags($name)->map(function($tag) {
            return $tag->name;
        });
    }

    public function all()
    {
        return $this->tagRepository->getAll();
    }

    public function findOrFail($id)
    {
        return $this->tagRepository->findOrFail($id);
    }

    public function paginate($page)
    {
        return $this->tagRepository->paginate($page);
    }
}