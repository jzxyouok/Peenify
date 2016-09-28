<?php

namespace App\Http\Controllers\Backend;

use App\Services\RoleService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * @var RoleService
     */
    private $roleSerive;

    public function __construct(RoleService $roleService)
    {
        $this->roleSerive = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleSerive->all();

        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->roleSerive->create($request->all());

        return redirect()->route('roles.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $role = $this->roleSerive->findOrFail($id);

        return view('backend.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = $this->roleSerive->findOrFail($id);

        return view('backend.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->roleSerive->update($id, $request->all());

        return redirect()->back()->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->roleSerive->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
