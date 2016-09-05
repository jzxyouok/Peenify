<?php

namespace App\Services;

use App\Repositories\ActorRepository;

class ActorService extends Service
{
    /**
     * @var ActorRepository
     */
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function all()
    {
        return $this->actorRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->actorRepository->create($this->authUser($attributes));
    }

    public function findOrFail($id)
    {
        return $this->actorRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->actorRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->actorRepository->destroy($id);
    }
}