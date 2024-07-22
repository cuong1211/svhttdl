<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Custom\BannerRequest;
use App\Models\banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banner = banner::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
            )->latest()->paginate(10)->appends($request->all());;
        return view('admin.custom.banner.index', ['banner' => $banner]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.custom.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $data = $request->validated();
        $banner = banner::create($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $banner->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('banner_image');
        }
        return redirect()->route('admin.banners.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới banner thành công',
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
        return view('admin.custom.banner.edit', ['banner' => banner::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $id)
    {
        $data = $request->validated();
        $banner = banner::findOrFail($id);
        $banner->update($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $banner->clearMediaCollection('banner_image');
            $banner->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('banner_image');
        }
        return redirect()->route('admin.banners.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật banner thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = banner::findOrFail($id);
        $banner->clearMediaCollection('banner_image');
        $banner->delete();
        return redirect()->route('admin.banners.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa banner thành công',
        ]);
    }
}
