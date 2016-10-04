<?php

namespace App\Http\Controllers;

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
        $collections = $this->collectionService->all();

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(Request $request)
    {
        $this->collectionService->create($request->all());

        return redirect()->route('collections.index')->with('message', '建立成功');
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

    public function update(Request $request, $id)
    {
        $this->collectionService->update($id, $request->all());

        return redirect()->route('collections.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->collectionService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }

    public function showByUser($user_id)
    {
        $collections = $this->collectionService->findByUser($user_id);

        return view('users.collections', compact('collections'));
    }

    /**
     * @param Request $request
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProduct(Request $request, $product_id)
    {
        if ($this->collectionService->duplicateProductInCollection($request->get('collection_id'), $product_id)) {
            return redirect()->back()->with('message', '重複了');
        }

        $this->collectionService->attachProduct($request->get('collection_id'), $product_id);

        return redirect()->back()->with('message', '加入成功');
    }
}
