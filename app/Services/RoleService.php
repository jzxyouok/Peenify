<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends Service
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return $this->roleRepository->all();
    }

    public function create(array $attributes)
    {
        return auth()->user()->relatedRoles()
            ->create($attributes)->syncPermissionsTo((array)$attributes['permissions']);
    }

    public function findOrFail($id)
    {
        return $this->roleRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->roleRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->roleRepository->destroy($id);
    }

    public function getAllPagination($page)
    {
        return $this->roleRepository->LatestPagination($page);
    }
}