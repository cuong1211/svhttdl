<?php

namespace App\Http\Controllers\Admin\Album;

use App\Enums\AlbumTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PhotoRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.albums.photos.index', [
            'photos' => Photo::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
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
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::PHOTO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.photos.create', compact('albums'));
    }

    public function store(PhotoRequest $request)
    {
        $photo = new Photo([
            'album_id' => $request->album_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);
        $photo->save();
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $photo->addMediaFromRequest('image')
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('album_photo');
        }

        return redirect()->route('admin.photos.index')->with('success', 'Photo created successfully.');
    }

    /**
     * @return Factory|View
     */
    public function edit($id): View
    {
        $photo = Photo::findOrFail($id);
        $albums = Album::query()
            ->where('type', AlbumTypeEnum::PHOTO)
            ->select('id', 'name')
            ->get();

        return view('admin.albums.photos.edit')
            ->with([
                'photo' => $photo,
                'albums' => $albums,
            ]);
    }

    public function update(Request $request, Photo $photo)
    {
        $photo->update([
            'album_id' => $request->album_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);
        if ($request->hasFile('image')) {
            $photo->clearMediaCollection('album_photo');
            $photo->addMediaFromRequest('image')
                ->usingFileName($request->image->getClientOriginalName())
                ->usingName($request->image->getClientOriginalName())
                ->toMediaCollection('album_photo');
        }

        return redirect()->route('admin.photos.index')->with('success', 'Photo updated successfully.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return redirect()->route('admin.photos.index')->with('success', 'Photo deleted successfully.');
    }
}
