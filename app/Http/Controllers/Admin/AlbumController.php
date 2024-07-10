<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.index', [
            'albums' => Album::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create(): View
    {
        return view('admin.albums.create');
    }

    public function store(AlbumRequest $request)
    {
        // dd($request->all());
        $request->validated();
        $album = Album::create($request->all());
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            // dd($imageFile);
            $album->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_thumb');
        }

        return redirect()->route('admin.albums.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo album thành công',
        ]);
    }

    /**
     * @return Factory|View
     */
    public function edit(Album $album): View
    {
        return view('admin.albums.edit')
            ->with([
                'album' => $album,
            ]);
    }

    public function update(AlbumRequest $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $album->update($request->all());
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $album->clearMediaCollection('album_thumb');
            $album->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_thumb');
        }

        return redirect()->route('admin.albums.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhập album thành công',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Album $album)
    {
        
        $album->delete();

        return redirect()->route('admin.albums.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'xóa album thành công',
        ]);
    }
}
