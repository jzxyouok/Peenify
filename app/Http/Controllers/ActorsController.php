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
        $actors = $this->actorService->getAllPagination(10);

        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $filename = (is_null($request->file('avatar'))) ? null : upload_image('avatars.actors', $request->file('avatar'));

        $data = $request->all();

        $this->actorService->create(array_set($data, 'avatar', $filename));

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
        $this->actorService->update($id, update_image($request, 'avatar', 'avatars.actors'));

        return redirect()->back()->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->actorService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
