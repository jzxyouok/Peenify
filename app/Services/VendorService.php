<?php

namespace App\Services;

use App\Repositories\VendorRepository;

class VendorService extends Service
{
    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {

        $this->vendorRepository = $vendorRepository;
    }

    public function all()
    {
        return $this->vendorRepository->all();
    }

    public function create(array $attributes)
    {
        return auth()->user()->vendors()->create($attributes);
    }

    public function findOrFail($id)
    {
        return $this->vendorRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->vendorRepository->update($id, $this->authUser($attributes));
    }

    public function destroy($id)
    {
        return $this->vendorRepository->destroy($id);
    }

    public function getAllPagination($page)
    {
        return $this->vendorRepository->LatestPagination($page);
    }
}