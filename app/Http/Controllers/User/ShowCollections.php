<?php

namespace App\Http\Controllers\User;

use App\Services\CollectionService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowCollections extends Controller
{
    /**
     * @var CollectionService
     */
    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function __invoke($id)
    {
        $collections = $this->collectionService->getPaginationByUser($id, 12);

        return view('users.collections', compact('collections'));
    }
}
