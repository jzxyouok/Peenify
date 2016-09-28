<?php

namespace App\Http\Controllers\Backend;

use App\Services\PermissionService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * @var PermissionService
     */
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionService->all();

        return view('backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->permissionService->create($request->all());

        return redirect()->route('permissions.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $permission = $this->permissionService->findOrFail($id);

        return view('backend.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = $this->permissionService->findOrFail($id);

        return view('backend.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->permissionService->update($id, $request->all());

        return redirect()->back()->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->permissionService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
