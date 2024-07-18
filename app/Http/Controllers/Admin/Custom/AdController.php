<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Custom\AdsRequest;
use App\Models\ads;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ads = ads::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
            )
            ->latest()->paginate(10);
        return view('admin.custom.ads.index', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.custom.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsRequest $request)
    {
        $data = $request->validated();
        $ads = ads::create($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $ads->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('ads_image');
        }
        return redirect()->route('admin.ads.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới liên kết thành công',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.custom.ads.edit', ['ads' => ads::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsRequest $request, string $id)
    {
        $data = $request->validated();
        $ads = ads::findOrFail($id);
        $ads->update($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $ads->clearMediaCollection('ads_image');
            $ads->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('ads_image');
        }
        return redirect()->route('admin.ads.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật liên kết thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ads = ads::findOrFail($id);
        $ads->clearMediaCollection('ads_image');
        $ads->delete();
        return redirect()->route('admin.ads.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa liên kết thành công',
        ]);
    }
}
