<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Custom\AddOnRequest;
use Illuminate\Http\Request;
use App\Models\Addon;

class AddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $addons = Addon::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
            )->latest()->paginate(10)->appends($request->all());;
        return view('admin.custom.addon.index', ['addons' => $addons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.custom.addon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddOnRequest $request)
    {
        $data = $request->validated();
        $addon = Addon::create($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $addon->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('addon_image');
        }
        return redirect()->route('admin.addons.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới quảng cáo thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.custom.addon.edit', ['addons' => Addon::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddOnRequest $request, string $id)
    {
        $data = $request->validated();
        $addon = Addon::findOrFail($id);
        $addon->update($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $addon->clearMediaCollection('addon_image');
            $addon->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('addon_image');
        }
        return redirect()->route('admin.addons.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật quảng cáo thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addon = Addon::findOrFail($id);
        $addon->clearMediaCollection('addon_image');
        $addon->delete();
        return redirect()->route('admin.addons.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa quảng cáo thành công',
        ]);
    }
}
