<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends Service
{
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function all()
    {
        return $this->permissionRepository->all();
    }

    public function create(array $attributes)
    {
        return auth()->user()->permissions()->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->permissionRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->permissionRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->permissionRepository->destroy($id);
    }

    public function getAllPagination($page)
    {
        return $this->permissionRepository->LatestPagination($page);
    }
}