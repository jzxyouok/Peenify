<?php

namespace App\Http\Controllers;

use App\Services\VendorService;
use Illuminate\Http\Request;

use App\Http\Requests;

class VendorsController extends Controller
{
    /**
     * @var VendorService
     */
    private $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }


    public function index()
    {
        $vendors = $this->vendorService->getAllPagination(10);

        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $this->vendorService->create($request->all());

        return redirect()->route('vendors.index')->with('message', '建立成功');
    }

    public function show($id)
    {
        $vendor = $this->vendorService->findOrFail($id);

        return view('vendors.show', compact('vendor'));
    }

    public function edit($id)
    {
        $vendor = $this->vendorService->findOrFail($id);

        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $this->vendorService->update($id, $request->all());

        return redirect()->back()->with('message', '編輯成功');
    }

    public function destroy($id)
    {
        $this->vendorService->destroy($id);

        return redirect()->back()->with('message', '刪除成功');
    }
}
