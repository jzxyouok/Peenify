<?php

namespace App\Http\Controllers;

use App\Http\Requests\Collection\createRequest;
use App\Http\Requests\Collection\updateRequest;
use App\Services\CollectionService;
use Illuminate\Http\Request;

use App\Http\Requests;

class CollectionsController extends Controller
{
    /**
     * @var CollectionService
     */
    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function index()
    {
        $collections = $this->collectionService->getAllPagination(12);

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(createRequest $request)
    {
        $collection = $this->collectionService->create($request->all());

        return redirect()->route('collections.show', $collection->id)->with('message', '建立成功');
    }

    public function show($id)
    {
        $collection = $this->collectionService->findOrFail($id);

        return view('collections.show', compact('collection'));
    }

    public function edit($id)
    {
        $collection = $this->collectionService->findOrFail($id);

        return view('collections.edit', compact('collection'));
    }

    public function update(updateRequest $request, $id)
    {
        $this->collectionService->update($id, $request->all());

        return redirect()->route('collections.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->collectionService->destroy($id);

        return redirect()->route('users.collections', auth()->user()->id)->with('message', '刪除成功');
    }
}
