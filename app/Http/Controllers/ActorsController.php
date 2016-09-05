<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ActorsController extends Controller
{
    /**
     * @var ActorService
     */
    private $actorService;

    public function __construct(ActorService $actorService)
    {
        $this->actorService = $actorService;
    }


    public function index()
    {
        $actors = $this->actorService->all();

        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $this->actorService->create($request->all());

        return redirect()->route('actors.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $actor = $this->actorService->findOrFail($id);

        return view('actors.show', compact('actor'));
    }

    public function edit($id)
    {
        $actor = $this->actorService->findOrFail($id);

        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, $id)
    {
        $this->actorService->update($id, $request->all());

        return redirect()->route('actors.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->actorService->destroy($id);

        return redirect()->route('actors.index')->with('message', '刪除成功');
    }
}
