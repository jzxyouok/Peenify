<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthorsController extends Controller
{
    /**
     * @var AuthorService
     */
    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }


    public function index()
    {
        $authors = $this->authorService->all();

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $this->authorService->create($request->all());

        return redirect()->route('authors.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $author = $this->authorService->findOrFail($id);

        return view('authors.show', compact('author'));
    }

    public function edit($id)
    {
        $author = $this->authorService->findOrFail($id);

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->authorService->update($id, $request->all());

        return redirect()->route('authors.show', $id)->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->authorService->destroy($id);

        return redirect()->route('authors.index')->with('message', '刪除成功');
    }
}